<?php

namespace Modules\Tour\Models;

use App\BaseModel;

class CogsPackage extends BaseModel {

    protected $table = 'makanans';

    public function hpp() {
        return $this->hasOne(CogsHpp::class, 'makanan_id');
    }
}
