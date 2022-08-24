<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRGajiDDetailBorongan extends Model
{
    use HasFactory;

    protected $table = 'public.hrgajid_det_borongan';

    protected $keyType = 'string';

    protected $primaryKey = 'hrgajid_oid';
}
