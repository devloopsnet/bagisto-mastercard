# Bagisto MasterCard Payment Gateway

### 1. Introduction:

This package provides MasterCard as a payment gateway for bagisto, it supports testing mode.

### 2. Requirements:

* **Bagisto**: v1.3.1.

### 3. Installation:

* Install the Bagisto MasterCard Payment Gateway extension

```
composer require devloopsnet/bagisto-mastercard
```

* Run these commands below to complete the setup

```
php artisan config:cache
```

```
php artisan migrate
```

```
php artisan route:cache
```

```
php artisan vendor:publish

-> Press 0 and then press enter to publish all assets and configurations.
```

### 4. Setup

Navigate to ```admin/configuration/sales/paymentmethods``` by going to Configure -> Sales -> Payment Methods

Then you can fill in the needed credentials provided by your account manager, which are Access Token and Entity Id

- Make sure to enable testing mode when testing.
- Using live credentials with testing mode enabled will cause the payment gateway to stop working properly.