<?php namespace Talentos\Providers;

use Illuminate\Support\ServiceProvider;

class HelperServiceProvider extends ServiceProvider {

   /**
    * Bootstrap the application services.
    *
    * @return void
    */
   public function boot()
   {
      //
   }

   /**
    * Register the application services.
    *
    * @return void
    */
   public function register()
   {
        //die(var_dump(glob(app_path().'/Helpers/*.php')));
        foreach (glob(app_path().'/Helpers/*.php') as $filename){
            #die(var_dump($filename));
            require_once($filename);
            #return new \Talentos\Helpers\Charts;
        }
   }
}