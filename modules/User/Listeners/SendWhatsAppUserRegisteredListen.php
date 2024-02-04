<?php

namespace Modules\User\Listeners;

use App\Services\WhatsAppService;
use Illuminate\Support\Facades\Mail;
use Modules\User\Emails\RegisteredEmail;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Events\SendWhatsAppUserRegistered;
use Modules\User\Models\User;

class SendWhatsAppUserRegisteredListen
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Handle the event.
     *
     * @param Event $event
     * @return void
     */
    public function handle(SendWhatsAppUserRegistered $event)
    {
        $user = $event->user;
        $param = [
            'target' => $user->phone,
            'message' => "[REGISTER JAMAAH] - alibinaliwisata\n\nPendaftaran anda sebagai jamaah berhasil.\nSilahkan login ke " . url('login') . " dengan data sebagai berikut: \n\n=========Credentials========== \n\nusername: *" . $user->email . "* \npassword: *" . $user->pass_code . "* \n\n============================ \n\nHarap segera mengganti password anda setelah melakukan login \n\nHubungi: " . url('/') . "\n\nhttps://wa.me/" . config('services.whatsapp.number')
        ];
        WhatsAppService::sendMessage($param);
    }
}
