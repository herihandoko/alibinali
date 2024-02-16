<?php
namespace Modules\User\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kabupaten extends BaseModel
{
    use SoftDeletes;
    
    protected $table = 'indonesia_cities';
    
    protected $fillable = [
        'id',
        'code',
        'name',
        'provinsi_code'
    ];
}