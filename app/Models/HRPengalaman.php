<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPengalaman extends Model
{
    use HasFactory;

    protected $table = 'public.hr_pengalaman';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpeng_oid';
}
