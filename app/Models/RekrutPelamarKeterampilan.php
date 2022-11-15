<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekrutPelamarKeterampilan extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pelamar_ketrampilan";

    protected $keyType = 'string';

    protected $primaryKey = 'ket_oid';

    protected $guarded = [];

    public $timestamps = false;
}
