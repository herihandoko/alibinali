<?php

namespace Modules\User\Listeners;

use App\Services\WhatsAppService;
use Modules\User\Events\SendWhatsAppUserRegistered;
use Modules\User\Events\SendWhatsAppUserResetPassword;
use Modules\User\Models\User;

class SendWhatsAppUserResetPasswordListen
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
    public function handle(SendWhatsAppUserResetPassword $event)
    {
        $user = $event->user;
        $param = [
            'target' => $user->phone,
            'message' => "[RESET PASSWORD] - alibinaliwisata\n\nSilahkan login ke " . url('login') . " dengan data sebagai berikut: \n\n=========Credentials========== \n\nusername: *" . $user->email . "* \npassword: *" . $user->pass_code . "* \n\n============================ \n\nHarap segera mengganti password anda setelah melakukan login \n\nHubungi: " . url('/') . "\n\nhttps://wa.me/" . config('services.whatsapp.number')
        ];
        WhatsAppService::sendMessage($param);
    }
}
