<?php
namespace Modules\User\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorReferral extends BaseModel
{
    use SoftDeletes;
    
    protected $table = 'vendor_referral';
    
    protected $fillable = [
        'code_auto',
        'referral_code',
        'user_id',
        'referral_count',
        'points',
    ];
}