<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekrutPelamarPengalaman extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pelamar_pengalaman";

    protected $keyType = 'string';

    protected $primaryKey = 'peng_oid';

    protected $guarded = [];

    public $timestamps = false;
}
