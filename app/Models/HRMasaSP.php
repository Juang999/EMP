<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRMasaSP extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_masa_sp';

    protected $keyType = 'string';

    protected $primaryKey = 'hrsp_oid';

    protected $guarded = [];

    public $timestamps = false;

    public function HRPeriodeMaster()
    {
        return $this->belongsTo(HRPeriodeMaster::class, 'hrsp_start_periode', 'hrperiode_code');
    }
}
