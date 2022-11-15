<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekrutPelamarOrganisasi extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pelamar_organisasi";

    protected $keyType = 'string';

    protected $primaryKey = 'org_oid';

    protected $guarded = [];

    public $timestamps = false;
}
