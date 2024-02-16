<?php
namespace Modules\User\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kecamatan extends BaseModel
{
    use SoftDeletes;
    
    protected $table = 'indonesia_districts';
    
    protected $fillable = [
        'id',
        'code',
        'name'
    ];
}