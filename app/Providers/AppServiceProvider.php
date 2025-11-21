<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Kirim variabel $unreadCount ke file layouts.admin secara otomatis
        View::composer('layouts.admin', function ($view) {
            $unreadCount = Contact::where('is_read', false)->count();
            $view->with('unreadCount', $unreadCount);
        });
    }
}