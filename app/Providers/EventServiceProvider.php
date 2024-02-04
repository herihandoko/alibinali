<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Auth\Listeners\SendWhatsAppNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Booking\Events\EnquirySendEvent;
use Modules\Booking\Listeners\EnquiryNotifyListen;
use Modules\Booking\Listeners\EnquirySendListen;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Events\SendWhatsAppUserRegistered;
use Modules\User\Events\SendWhatsAppUserResetPassword;
use Modules\User\Events\VendorApproved;
use Modules\User\Listeners\SendMailUserRegisteredListen;
use Modules\User\Listeners\SendNotifyApproved;
use Modules\User\Listeners\SendNotifyRegistered;
use Modules\User\Listeners\SendNotifyRegisteredListen;
use Modules\User\Listeners\SendVendorApprovedMail;
use Modules\User\Listeners\SendVendorApprovedWhatsapp;
use Modules\User\Listeners\SendVendorRegisterdEmail;
use Modules\User\Listeners\SendVendorRegisterdWhatsApp;
use Modules\User\Listeners\SendWhatsAppUserRegisteredListen;
use Modules\User\Listeners\SendWhatsAppUserResetPasswordListen;
use Modules\Vendor\Events\PayoutRequestEvent;
use Modules\Vendor\Listeners\PayoutNotifyListener;
use Modules\Vendor\Listeners\PayoutRequestNotificationListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            // SendWhatsAppNotification::class
        ],
        SendMailUserRegistered::class => [
            SendMailUserRegisteredListen::class,
            SendNotifyRegisteredListen::class
        ],
        VendorApproved::class => [
            SendVendorApprovedMail::class,
            SendNotifyApproved::class,
            SendVendorApprovedWhatsapp::class
        ],
        NewVendorRegistered::class => [
            SendVendorRegisterdEmail::class,
            SendNotifyRegistered::class,
            SendVendorRegisterdWhatsApp::class
        ],
        // VendorLogPayment::class => [
        //     VendorLogPaymentListen::class
        // ],
        PayoutRequestEvent::class => [
            PayoutRequestNotificationListener::class,
            PayoutNotifyListener::class
        ],
        EnquirySendEvent::class => [
            EnquirySendListen::class,
            EnquiryNotifyListen::class
        ],
        SendWhatsAppUserRegistered::class => [
            SendWhatsAppUserRegisteredListen::class
        ],
        SendWhatsAppUserResetPassword::class => [
            SendWhatsAppUserResetPasswordListen::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents()
    {
        return false;
    }
}
