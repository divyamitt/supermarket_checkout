<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Repositories\Checkout\CheckoutRepository;
use App\Repositories\Checkout\CheckoutRepositoryInterface;

class RepositoriesServiceProvider extends ServiceProvider
{
   /**
    * Register services.
    *
    * @return void
    */
   public function register()
   {
      //
   }

   /**
    * Bootstrap services.
    *
    * @return void
    */
   public function boot()
   {
      // Bundle Repository Interface
      $this->app->bind(CheckoutRepositoryInterface::class, CheckoutRepository::class);
   }
}
