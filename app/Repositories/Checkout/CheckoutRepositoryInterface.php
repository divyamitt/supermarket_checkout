<?php

namespace App\Repositories\Checkout;

interface CheckoutRepositoryInterface
{
   public function scanOrderDetail($orderData);

   public function getCheckoutPriceDetail($order);

}
