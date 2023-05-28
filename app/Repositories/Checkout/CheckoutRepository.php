<?php

namespace App\Repositories\Checkout;

// use App\Models\CheckoutOrder;

use App\Repositories\Checkout\CheckoutRepositoryInterface;

class CheckoutRepository implements CheckoutRepositoryInterface
{

   /**
    * Scan Order Detail
    * @param Object $orderData
    * @return Object $order
    */
   public function scanOrderDetail($orderData)
   {
      $scanOrder = array(
         'sku' => array_count_values(array_column($orderData['orders'], 'sku'))
      );
   
      $orderList = array();
      foreach($scanOrder['sku'] as $key => $qty){

         $keynew  = array_search($key, array_column($orderData['orders'], 'sku'));
         $order['sku'] = $key;
         $order['quantity'] = $qty;
         $order['unit_price'] = $orderData['orders'][$keynew]['unit_price'];

         array_push($orderList, $order);
      }

      return $orderList;
   }


   /**
    * Get checkout price detail
    * @param $orderList
    * @return Object $checkoutPrice
    */ 
   public function getCheckoutPriceDetail($orderList)
   {
      $totalCost = 0;
      if (count($orderList['orderList']) > 0) {
         foreach ($orderList['orderList'] as $order) {   

            if( $order['unit_price'] == 50){
               $productPrice = $this->productDiscount($order['unit_price'], $order['quantity'], 130, 3);
            }else if( $order['unit_price'] == 30){
               $productPrice = $this->productDiscount($order['unit_price'], $order['quantity'], 45, 2);  
            }else{
               $productPrice = $order['unit_price'] * $order['quantity'] ;
            } 
      
            $totalCost += $productPrice;  
         }

         // festival discount apply
         $festivalDiscountPrice = $this->festivalDiscount($totalCost, 0);
         $totalCost = $totalCost - $festivalDiscountPrice ;

         return [ 'total_cost' => $totalCost ];
      } else {
         return [ 'total_cost' => $totalCost ];
      }
   }



   /**
    * product discount calculation
    * @param $price, $qty, $discountPrice, $discountQty
    * @return Object $productPrice
    */ 
   public function productDiscount($price, $qty, $discountPrice, $discountQty)
   {      
      $offerPrice = floor($qty / $discountQty) * $discountPrice ;
      $actualPrice = ($qty % $discountQty) * $price ;
      $productPrice = $offerPrice + $actualPrice ;
      
      return $productPrice;
   }


   /**
    * festival offer discount
    * @param $totalPrice, $discountPercentage
    * @return Object $festivalDiscountPrice
    */ 
    public function festivalDiscount($totalPrice, $discountPercentage)
    {    
      $festivalDiscountPrice =  ( $totalPrice * $discountPercentage ) / 100;
       
      return $festivalDiscountPrice;
    }

}
