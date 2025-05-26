<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use App\Models\User;
use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\View;
use App\Models\Module;
use App\Models\HistoriqueUsers;

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
        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->subject('Vérification')
                ->view('mails.ui-passwordResetEmailPage', [
                    'url' => $url
                ]);
        });

        //On passe la variable $modulesBrokenDown à toutes les view
        View::composer('*', function ($view) { // '*' signifie que la variable sera disponible partout
            $modulesBrokenDown = Module::whereHas('details', function ($query) {
                $query->where('module_state', 2);
            })->get();
    
            $view->with('modulesBrokenDown', $modulesBrokenDown);
        });
    }

}