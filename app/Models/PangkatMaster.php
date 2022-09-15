<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
