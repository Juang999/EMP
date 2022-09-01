<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKotaUmk extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_kota_umk';

    protected $keyType = 'string';

    protected $primaryKey = 'kode';
}
