<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKeluarga extends Model
{
    use HasFactory;

    protected $table = 'public.hr_keluarga';

    protected $keyType = 'string';

    protected $primaryKey = 'hrkel_oid';
}
