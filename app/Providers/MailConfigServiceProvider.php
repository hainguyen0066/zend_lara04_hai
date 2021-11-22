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
                $config = array(
                    'driver'     => 'smtp',
                    'host'       => 'smtp.gmail.com',
                    'port'       => '465',
                    'from'       => array('address' => $mailsetting['email'], 'name' => env('APP_NAME')),
                    'encryption' => 'ssl',
                    'username'   => $mailsetting['email'],
                    'password'   => $mailsetting['password'],
                    'sendmail'   => '/usr/sbin/sendmail -bs',
                    'pretend'    => false,
                );
                Config::set('mail', $config);
            }
    }
}
