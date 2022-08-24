<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRMasaSP extends Model
{
    use HasFactory;

    protected $table = 'public.hr_masa_sp';

    protected $keyType = 'string';

    protected $primaryKey = 'hrsp_oid';
}
