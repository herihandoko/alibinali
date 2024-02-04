<?php

namespace Modules\User\Listeners;

use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\RegisteredEmail;
use Modules\User\Emails\VendorApprovedEmail;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Events\VendorApproved;
use Modules\User\Models\User;
use Modules\User\Models\VendorReferral;
use Modules\Vendor\Models\VendorRequest;

class SendVendorApprovedWhatsapp
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $user;
    public $vendorRequest;

    const CODE = [
        'first_name' => '[first_name]',
        'last_name'  => '[last_name]',
        'name'       => '[name]',
        'email'      => '[email]',
    ];

    public function __construct(User $user, VendorRequest $vendorRequest)
    {
        $this->user = $user;
        $this->vendorRequest = $vendorRequest;
        //
    }

    /**
     * Handle the event.
     *
     * @param Event $event
     * @return void
     */
    public function handle(VendorApproved $event)
    {
        if ($event->user->locale) {
            $old = app()->getLocale();
            app()->setLocale($event->user->locale);
        }

        $user = $event->user;
        $kode = VendorReferral::where('user_id', $user->id)->first();
        $param = [
            'target' => $user->phone,
            'message' => "[APPROVAL MITRA] - alibinaliwisata\n\nSelamat permintaan menjadi MITRA alibinaliwisata disetujui, berikut kode refferal Anda:\n\nKODE REFERRAL: *" . $kode->referral_code . "* \n\n============================ \n\nHubungi: " . url('/') . "\n\nhttps://wa.me/" . config('services.whatsapp.number')
        ];
        WhatsAppService::sendMessage($param);

        if (!empty($old)) {
            app()->setLocale($old);
        }
    }
}
