<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpMaster extends Model
{
    use HasFactory;

    protected $table = 'public.emp_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'emp_oid';

    protected $guarded = [];

    public $timestamps = false;

    protected $hidden = ['emp_photo'];

    public function PangkatMaster()
    {
        return $this->belongsTo(PangkatMaster::class, 'emp_pangkat_id', 'pangkat_id');
    }

    public function Jabatan()
    {

    }
}
