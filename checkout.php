<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51O8YpjFc7pOXKBxq8eYuUZqBKH3GtFFGXfEqGg7RLtWOL2fbZnMzFtYmRgtJWTwrjljDkymlGDYKUCJh0TfStOOn00LAkm7yuj";

\Stripe\Stripe::setApiKey($stripe_secret_key);

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/success.php",
    "cancel_url" => "http://localhost/payment.php",
    "locale" => "auto",
    #change this to the env variables for the products.
    "line_items" => [
        [
            "quantity" => 1,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 2000,
                "product_data" => [
                    "name" => "T-shirt"
                ]
            ]
        ],
        [
            "quantity" => 2,
            "price_data" => [
                "currency" => "usd",
                "unit_amount" => 700,
                "product_data" => [
                    "name" => "Hat"
                ]
            ]
        ]        
    ]
]);

http_response_code(303);
header("Location: " . $checkout_session->url);