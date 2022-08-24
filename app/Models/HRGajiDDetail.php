<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRGajiDDetail extends Model
{
    use HasFactory;

    protected $table = 'public.hrgajid_det';

    protected $keyType = 'string';

    protected $primaryKey = 'hrgajid_oid';
}
