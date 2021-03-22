<?php

namespace App\Providers;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Http\Library\Helper;

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

        /**
         * log the SQL queryes for debuging
         */
        if(config('env.APP_DEBUG')) {
         DB::listen(function($query) {
             File::append(
                 storage_path('/logs/query.log'),
                 $query->sql . ' [' . implode(', ', $query->bindings) . ']' . PHP_EOL
            );
         });
        }

        Validator::extend('nifextension', function($attribute, $value, $parameters, $validator) {
//            dd($attribute, $value, $parameters, $validator);
            if(!empty($attribute) && $attribute=='nif' && !empty($value)){
                return Helper::valida_nif($value);
            }
        });
        Schema::defaultstringLength(191);
        $this->app->alias('bugsnag.logger', \Illuminate\Contracts\Logging\Log::class);
        $this->app->alias('bugsnag.logger', \Psr\Log\LoggerInterface::class);
    }
}
