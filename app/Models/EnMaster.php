<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Modules\PIM\Entities\EmpMaster;

class EnMaster extends Model
{
    use HasFactory;

    protected $table = 'public.en_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'en_oid';

    public function EmpMaster()
    {
        return $this->hasMany(EmpMaster::class, 'en_id', 'emp_en_id');
    }
}
