<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth; 
use App\Models\Message;

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
        View::composer('*', function ($view) {
            if (Auth::check()) {
                // Hitung jumlah pesan belum dibaca
                $unreadMessagesCount = Message::where('receiver_id', Auth::id())->whereNull('read_at')->count();

                $view->with('notifications', Auth::user()->unreadNotifications);
                $view->with('unreadMessagesCount', $unreadMessagesCount); // Kirim data ke view
            }
        });
    }

    
}
