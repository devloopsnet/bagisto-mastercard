<?php

namespace Devloops\MasterCard\Http\Controllers;

use Illuminate\View\View;
use Webkul\Checkout\Facades\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Contracts\View\Factory;
use Devloops\MasterCard\Payment\MasterCard;
use Webkul\Sales\Repositories\OrderRepository;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class MasterCardController
 *
 * @package Devloops\MasterCard\Http\Controllers
 * @date 29/09/2021
 * @author Abdullah Al-Faqeir <abdullah@devloops.net>
 */
class MasterCardController extends Controller
{

    /**
     * OrderRepository object
     *
     * @var \Webkul\Sales\Repositories\OrderRepository
     */
    protected OrderRepository $orderRepository;

    /**
     * Create a new controller instance.
     *
     * @param  \Webkul\Sales\Repositories\OrderRepository  $orderRepository
     *
     */
    public function __construct(
        OrderRepository $orderRepository,
    ) {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param $cartId
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function success($cartId): RedirectResponse
    {
        $order = $this->orderRepository->create(Cart::prepareDataForOrder());

        Cart::deActivateCart();

        session()->flash('order', $order);

        return redirect()->route('shop.checkout.success');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cancel(): RedirectResponse
    {
        session()->flash('error', 'Mastercard payment has been canceled.');

        return redirect()->route('shop.checkout.cart.index');
    }

    /**
     * @param $cartId
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
     */
    public function redirect($cartId): Factory|View|Application|RedirectResponse
    {
        $data = request()->only([
            'session_id',
            'merchant',
            'order_amount',
            'order_currency',
            'order_id',
            'order_description',
            'order_custom_orderId',
            'interaction_merchant_name',
            'interaction_merchant_phone',
            'interaction_merchant_email',
            'interaction_merchant_logo',
            'interaction_displayControl_billingAddress',
            'interaction_displayControl_customerEmail',
            'interaction_displayControl_orderSummary',
            'interaction_displayControl_shipping',
            'interaction_cancelUrl',
        ]);
        if (empty($data)) {
            return redirect()->to(route('mastercard.cancel', $cartId));
        }
        $url = MasterCard::POST_URL;
        return view('mastercard::redirect', compact('data', 'url'));
    }

}