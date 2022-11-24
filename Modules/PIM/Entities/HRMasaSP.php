<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
