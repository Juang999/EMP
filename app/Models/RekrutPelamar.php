<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekrutPelamar extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pelamar";

    protected $keyType = 'string';

    protected $primaryKey = 'plm_code';

    protected $guarded = [];

    public $timestamps = false;
}
