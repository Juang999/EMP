<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\EnMaster;

class EmpMaster extends Model
{
    use HasFactory;

    protected $table = 'public.emp_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'emp_oid';

    protected $guarded = [];

    public $timestamps = false;

    protected $hidden = ['emp_photo'];

    public function EnMaster()
    {
        return $this->belongsTo(EnMaster::class, 'emp_en_id', 'en_id');
    }

    public function TotalKeluarga()
    {
        return $this->hasMany(HRKeluarga::class, 'hrkel_emp_id', 'emp_id');
    }

    public function HRJabatanMaster()
    {
        return $this->belongsTo(HRJabatanMaster::class, 'emp_jabatan', 'hrjbt_id');
    }
}
