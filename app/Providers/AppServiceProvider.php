<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Cart;
use Illuminate\Support\Facades\Session;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
         Paginator::useBootstrapFour();
        view()->composer('banhang.layout.header',function($view){
        $loai_sp=ProductType::all();
        $view->with(['loai_sp'=>$loai_sp,]);

        });
        view()->composer(['banhang.layout.header','banhang.checkout'],function($view){
            if(Session('cart')){
                $oldCart=Session::get('cart');
                $cart=new Cart($oldCart);
                $view->with(['cart'=>Session::get('cart'),'product_cart'=>$cart->items,'totalPrice'=>$cart->totalPrice,'totalQty'=>$cart->totalQty]);
            }
        });
        // view()->composer('admin.layout.header',function($view){
        //     $product=Product::all();
        //     $view->with(['product'=>$product]);

        //     });

    }
}
