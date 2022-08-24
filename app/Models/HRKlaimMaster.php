<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKlaimMaster extends Model
{
    use HasFactory;

    protected $table = 'public.hrklaim_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrclaim_code';
}
