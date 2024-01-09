<?php
namespace Modules\User\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Provinsi extends BaseModel
{
    use SoftDeletes;
    
    protected $table = 'indonesia_provinces';
    
    protected $fillable = [
        'id',
        'code',
        'name'
    ];
}