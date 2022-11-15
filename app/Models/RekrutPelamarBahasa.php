<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekrutPelamarBahasa extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pelamar_bahasa";

    protected $keyType = 'string';

    protected $primaryKey = 'bhs_oid';

    protected $guarded = [];

    public $timestamps = false;
}
