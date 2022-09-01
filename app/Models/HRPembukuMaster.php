<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPembukuMaster extends Model
{
    use HasFactory;

    protected $table = 'public.hrpembuku_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpembuku_code';
}
