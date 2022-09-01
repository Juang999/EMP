<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRSantunanMaster extends Model
{
    use HasFactory;

    protected $table = 'public.hrsantunan_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrsantunan_code';
}
