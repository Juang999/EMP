<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekrutPengajuan extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pengajuan";

    protected $keyType = 'string';

    protected $primaryKey = 'pgj_code';

    protected $guarded = [];

    public $timestamps = false;
}
