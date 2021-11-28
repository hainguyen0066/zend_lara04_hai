<?php
namespace App\Providers;

use Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class MailConfigServiceProvider extends ServiceProvider
{
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
            $mailsetting = DB::table('setting')->where('key_value', 'setting-email')->first();
            $mailsetting = json_decode($mailsetting->value, true);

            if ($mailsetting) {
                // có thể cấu hình riêg lẻ
                Config::set('mail.username', $mailsetting['email']);
                Config::set('mail.password', $mailsetting['password']);
            }
    }
}
