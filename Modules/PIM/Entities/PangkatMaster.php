<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PangkatMaster extends Model
{
    use HasFactory;

    protected $table = 'hris.pangkat_mstr';

    protected $primaryKey = 'pangkat_id';

    public function EmpMaster()
    {
        return $this->hasMany(EmpMaster::class, 'pangkat_id', 'emp_pangkat_id');
    }
}
