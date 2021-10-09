<?php

namespace Devloops\MasterCard\Payment;

use Illuminate\Support\Facades\Http;
use Webkul\Payment\Payment\Payment;

/**
 * Class MasterCard.
 *
 * @date 29/09/2021
 *
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class MasterCard extends Payment
{
    /**
     * Payment method code.
     *
     * @var string
     */
    protected string $code = 'mastercard';

    /**
     * @var string
     */
    private string $checkoutSessionUrl = 'https://mepspay.gateway.mastercard.com/api/nvp/version/50';

    /**
     * @var
     */
    public const POST_URL = 'https://mepspay.gateway.mastercard.com/api/page/version/50/pay';

    public function getRedirectUrl(): string
    {
        /**
         * @var $cart \Webkul\Checkout\Models\Cart
         */
        $cart = $this->getCart();
        $params = [
            'apiOperation'          => 'CREATE_CHECKOUT_SESSION',
            'apiPassword'           => $this->getConfigData('merchant_password'),
            'apiUsername'           => 'merchant.'.$this->getConfigData('merchant_id'),
            'merchant'              => $this->getConfigData('merchant_id'),
            'order.id'              => "ORDER{$cart->id}",
            'order.amount'          => number_format($cart->grand_total, 3),
            'order.currency'        => $cart->cart_currency_code,
            'interaction.returnUrl' => route('mastercard.success', $cart->id),
        ];

        $rawResult = Http::contentType('application/x-www-form-urlencoded')
                              ->send('POST', $this->checkoutSessionUrl, [
                                  'body' => http_build_query($params),
                              ])
                              ->body();
        $apiSessionData = [];
        parse_str($rawResult, $apiSessionData);
        if ($apiSessionData['result'] === 'SUCCESS') {
            return $this->generateRedirectUrl($apiSessionData, $cart);
        }

        throw new \Exception('MasterCard Gateway Purchase Error : '.$apiSessionData['error_explanation']);
    }

    public function getConfigData($field)
    {
        return core()->getConfigData('sales.paymentmethods.'.$this->getCode().'.'.$field);
    }

    private function generateRedirectUrl(array $rawResult, $cart): string
    {
        $data = [
            'session.id'                                => $rawResult['session_id'],
            'merchant'                                  => $rawResult['merchant'],
            'order.amount'                              => number_format($cart->grand_total, 3),
            'order.currency'                            => $cart->cart_currency_code,
            'order.id'                                  => "ORDER{$cart->id}",
            'order.description'                         => 'Payment for order '.$cart->id,
            'order.custom.orderId'                      => "ORDER{$cart->id}",
            'interaction.merchant.name'                 => core()->getCurrentChannel()->name,
            'interaction.merchant.phone'                => '',
            'interaction.merchant.email'                => '',
            'interaction.merchant.logo'                 => core()->getCurrentChannel()->logo_url,
            'interaction.displayControl.billingAddress' => 'HIDE',
            'interaction.displayControl.customerEmail'  => 'HIDE',
            'interaction.displayControl.orderSummary'   => 'HIDE',
            'interaction.displayControl.shipping'       => 'HIDE',
            'interaction.cancelUrl'                     => route('mastercard.cancel', $cart->id),
        ];

        return route('mastercard.redirect', $cart->id).'?'.http_build_query($data);
    }
}
