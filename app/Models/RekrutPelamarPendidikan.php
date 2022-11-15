<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekrutPelamarPendidikan extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pelamar_pendidikan";

    protected $keyType = 'string';

    protected $primaryKey = 'genp_code';

    protected $guarded = [];

    public $timestamps = false;
}
