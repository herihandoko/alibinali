<?php

namespace Modules\Vendor\Models;

use App\BaseModel;
use App\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorTeam extends BaseModel
{
    use SoftDeletes;

    const STATUS_PUBLISH = 'publish';
    const STATUS_PENDING = 'pending';

    protected $table = 'vendor_team';

    protected $dates = ['deleted_at'];

    protected $casts = [
        'permissions' => 'array'
    ];

    public function vendor()
    {
        return $this->belongsTo(User::class, 'vendor_id');
    }
    public function member()
    {
        return $this->belongsTo(User::class, 'member_id');
    }

    public function membertree()
    {
        return $this->hasMany(VendorTeam::class, 'vendor_id', 'member_id');
    }
}
