<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKasbonMaster extends Model
{
    use HasFactory;

    protected $table = 'public.hrkasbon_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrkasbon_code';
}
