<?php

namespace App\Providers;

use App\Events\OrderPaidEvent;
use App\Listeners\SendOrderPaidEmail;
use Illuminate\Auth\Events\Login;
use App\Listeners\MergeCartListener;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
protected $listen = [
    \App\Events\OrderPaidEvent::class => [
        \App\Listeners\SendOrderPaidEmail::class,
    ],

        Login::class => [
            MergeCartListener::class,
        ],
    ];
}
