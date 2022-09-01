<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KpiMaster extends Model
{
    use HasFactory;

    protected $table = 'public.kpi_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'kpi_oid';
}
