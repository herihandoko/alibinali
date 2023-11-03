<?php

namespace Modules\User\Controllers\Auth;

use App\Helpers\ReCaptchaEngine;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rules\Password;
use Matrix\Exception;
use Modules\User\Events\SendMailUserRegistered;
use Modules\User\Models\VendorReferral;
use Modules\Vendor\Models\VendorTeam;

class RegisterController extends \App\Http\Controllers\Auth\RegisterController {

    public function register(Request $request)
    {
        if(!is_enable_registration()){
            return $this->sendError(__("Anda sudah terdaftar!"));
        }

        $rules = [
            'first_name' => [
                'required',
                'string',
                'max:255'
            ],
            'last_name'  => [
                'required',
                'string',
                'max:255'
            ],
            'email'      => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:users'
            ],
            'password'   => [
                'required',
                'string',
                Password::min(8)
                    ->mixedCase()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
            'phone'       => ['required','unique:users'],
            'term'       => ['required'],
        ];

        $messages = [
            'phone.required'      => __('Nomor Telp. wajib diisi'),
            'phone.unique'      => __('Nomor Telp. sudah terdaftar'),
            'email.required'      => __('Alamat Email wajib diisi'),
            'email.email'         => __('Alamat Email tidak valid'),
            'email.unique'      => __('Alamat Email sudah terdaftar'),
            'password.required'   => __('Password wajib diisi'),
            'first_name.required' => __('Nama Depan wajib diisi'),
            'last_name.required'  => __('Nama Belakang wajib diisi'),
            'term.required'       => __('Syarat dan Kebijakan Privasi belum tercentang'),
        ];

        if (ReCaptchaEngine::isEnable() and setting_item("user_enable_register_recaptcha")) {
            $codeCapcha = $request->input('g-recaptcha-response');
            if (!$codeCapcha or !ReCaptchaEngine::verify($codeCapcha)) {
                $errors = new MessageBag(['message_error' => __('Harap verifikasi captcha')]);
                return response()->json([
                    'error'    => true,
                    'messages' => $errors
                ], 200);
            }
        }

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors()
            ], 200);
        } else {
            if(!empty($request->input('referral_code'))) {
                $referralCode = VendorReferral::where('referral_code', $request->input('referral_code'))->first();
                if(empty($referralCode)) {
                    $errorRef = new MessageBag(['referral_code' => __('Kode Referral tidak ada')]);
                    return response()->json([
                        'error'    => true,
                        'messages' => $errorRef
                    ], 200);
                } else {
                    $user = \App\User::create([
                        'first_name' => $request->input('first_name'),
                        'last_name'  => $request->input('last_name'),
                        'email'      => $request->input('email'),
                        'password'   => Hash::make($request->input('password')),
                        'status'    => $request->input('publish','publish'),
                        'phone'    => $request->input('phone'),
                    ]);
                    
                    if($user->id != 0) {
                        $vendorReferral = VendorReferral::find($referralCode->id);
                        $vendorReferral->update([
                            'referral_count' => $vendorReferral->referral_count + 1,
                            'points' => $vendorReferral->points + 1,
                        ]);
                        
                        $saveVendorMember = new VendorTeam();
                        $saveVendorMember->vendor_id = $vendorReferral->user_id;
                        $saveVendorMember->member_id = $user->id;
                        $saveVendorMember->create_user = $user->id;
                        $saveVendorMember->status = VendorTeam::STATUS_PUBLISH;
                        $saveVendorMember->save();
                    }

                    event(new Registered($user));
                    Auth::loginUsingId($user->id);

                    try {
                        event(new SendMailUserRegistered($user));
                    } catch (Exception $exception) {
                        Log::warning("SendMailUserRegistered: " . $exception->getMessage());
                    }

                    $user->assignRole(setting_item('user_role'));
                    return response()->json([
                        'error'    => false,
                        'messages' => false,
                        'redirect' => $request->input('redirect') ?? $request->headers->get('referer') ?? url(app_get_locale(false, '/'))
                    ], 200);
                }
            } else {
                $user = \App\User::create([
                    'first_name' => $request->input('first_name'),
                    'last_name'  => $request->input('last_name'),
                    'email'      => $request->input('email'),
                    'password'   => Hash::make($request->input('password')),
                    'status'    => $request->input('publish','publish'),
                    'phone'    => $request->input('phone'),
                ]);

                event(new Registered($user));
                Auth::loginUsingId($user->id);

                try {
                    event(new SendMailUserRegistered($user));
                } catch (Exception $exception) {

                    Log::warning("SendMailUserRegistered: " . $exception->getMessage());
                }

                $user->assignRole(setting_item('user_role'));
                return response()->json([
                    'error'    => false,
                    'messages' => false,
                    'redirect' => $request->input('redirect') ?? $request->headers->get('referer') ?? url(app_get_locale(false, '/'))
                ], 200);
            }
        }
    }
}
