<?php

namespace Modules\User\Listeners;

use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\RegisteredEmail;
use Modules\User\Emails\VendorRegisteredEmail;
use Modules\User\Events\NewVendorRegistered;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Models\User;

class SendVendorRegisterdWhatsApp
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $user;
    const CODE = [
        'first_name'    => '[first_name]',
        'last_name'     => '[last_name]',
        'name'          => '[name]',
        'email'         => '[email]',
        'created_at'     => '[created_at]',
        'link_approved' => '[link_approved]',
        'button_verify' => '[button_verify]',
    ];

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param NewVendorRegistered $event
     * @return void
     */
    public function handle(NewVendorRegistered $event)
    {
        $user = $event->user;
        $param = [
            'target' => $user->phone,
            'message' => "[REGISTER MITRA] - alibinaliwisata\n\nPendaftaran anda sebagai MITRA telah kami terima dan sedang diverifikasi oleh admin. Informasi lebih lanjut akan kami kirimkan setelah proses verifikasi selesai. \n\n============================ \n\nHubungi: " . url('/') . "\n\nhttps://wa.me/" . config('services.whatsapp.number')
        ];
        WhatsAppService::sendMessage($param);
    }
}
