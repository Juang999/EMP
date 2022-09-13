<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrKpiMaster extends Model
{
    use HasFactory;

    protected $table = 'hris.kpi_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'kpi_oid';
}
