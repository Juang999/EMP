<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRShiftDPDetailPerson extends Model
{
    use HasFactory;

    protected $table = 'public.hrshiftd_det_person';

    protected $keyType = 'string';

    protected $primaryKey = 'hrshiftd_oid';
}
