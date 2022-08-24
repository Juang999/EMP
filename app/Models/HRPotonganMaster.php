<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPotonganMaster extends Model
{
    use HasFactory;

    protected $table = 'public.hrpotongan_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpot_code';
}
