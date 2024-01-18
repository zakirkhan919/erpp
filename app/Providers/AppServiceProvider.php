<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Auth;
use Illuminate\Pagination\Paginator;
use Livewire\Livewire;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function() {
            return realpath(base_path().'/..');
          });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Livewire::component('finance::transection.earn-form', \App\Modules\Finance\Http\Livewire\Transection\EarnForm::class);
        Livewire::component('finance::transection.earn-form-edit', \App\Modules\Finance\Http\Livewire\Transection\EarnFormEdit::class);

        Livewire::component('finance::transection.spend-form', \App\Modules\Finance\Http\Livewire\Transection\SpendForm::class);
        Livewire::component('finance::transection.spend-form-edit', \App\Modules\Finance\Http\Livewire\Transection\SpendFormEdit::class);


        Paginator::useBootstrap();

        view()->composer('*', function ($view)
        {
            if(\Auth::check()){
                $access = \App\Modules\User\Models\RolePermission::where("id",\Auth::guard("web")->user()->role_id)->first();
                $access ? config(['global.access' => json_decode($access->permission)]) : "";
            }
        });

    }
}
