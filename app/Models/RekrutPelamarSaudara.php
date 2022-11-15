<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekrutPelamarSaudara extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pelamar_saudara";

    protected $keyType = 'string';

    protected $primaryKey = 'saud_oid';

    protected $guarded = [];

    public $timestamps = false;
}
