<?php

return [
    [
        'key'    => 'sales.paymentmethods.mastercard',
        'name'   => 'MasterCard',
        'sort'   => 1,
        'fields' => [
            [
                'name'          => 'title',
                'title'         => 'admin::app.admin.system.title',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => true,
            ],
            [
                'name'          => 'description',
                'title'         => 'admin::app.admin.system.description',
                'type'          => 'textarea',
                'channel_based' => true,
                'locale_based'  => true,
            ],
            [
                'name'          => 'active',
                'title'         => 'admin::app.admin.system.status',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => false,
            ],
            [
                'name'          => 'merchant_id',
                'title'         => 'Merchant ID',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => false,
            ],
            [
                'name'          => 'merchant_password',
                'title'         => 'Merchant Password',
                'type'          => 'text',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => false,
            ],
            [
                'name'          => 'test_mode',
                'title'         => 'Testing Mode',
                'type'          => 'boolean',
                'validation'    => 'required',
                'channel_based' => true,
                'locale_based'  => false,
            ],
        ],
    ],
];