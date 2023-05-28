<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ScanOrderRequest;
use App\Http\Requests\OrderListRequest;
use App\Repositories\Checkout\CheckoutRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;



class CheckOutController extends Controller
{
   protected $checkoutRepo;

   public function __construct(CheckoutRepositoryInterface $checkoutRepo)
   {
      $this->checkoutRepo = $checkoutRepo;
   }


   //  request data format 
   /** 
   *  {
   *   "orders": [
   *      {
   *         "sku":"YU7676GJH",
   *         "unit_price": "50"
   *      },{
   *         "sku":"CUU986EHG",
   *         "unit_price": "30"
   *      },{
   *         "sku":"YU7676GJH",
   *         "unit_price": "50"
   *      }
   *   ]
   *  }
   * */

   /**
    * Scan Order Detail 
    * @param ScanOrderRequest Order Data
    * @return Object $order
    */ 
   public function scanOrderDetail(ScanOrderRequest $request)
   {
      $input = $request->all();
      $orderList = $this->checkoutRepo->scanOrderDetail($input);

      return response()->json([
         'status'    => true,
         'code'      => 200,
         'message'   => 'Scan Order Detail',
         'data'      => $orderList
      ]);
   }



   //  request data format
   /** 
   *   {
   *   "orderList": [
   *      {
   *         "sku":"YU7676GJH",
   *         "quantity": 3,
   *         "unit_price": "50"
   *      },{
   *         "sku":"CUU986EHG",
   *         "quantity": 1,
   *         "unit_price": "30"
   *      }
   *   ] 
   * }
   * */

   /**
    * Get checkout price detail
    * @param $request
    * @return Object $checkoutPrice
    */ 
   public function getCheckoutPriceDetail(OrderListRequest $request)
   {
      $data = $request->all();
      $checkoutPrice = $this->checkoutRepo->getCheckoutPriceDetail($data);

      return response()->json([
         'status'    => true,
         'code'      => 200,
         'message'   => 'Checkout Price',
         'data'      => $checkoutPrice
      ]);
   }

}
