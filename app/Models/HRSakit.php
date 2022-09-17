<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRSakit extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_sakit';

    protected $keyType = 'string';

    protected $primaryKey = 'hrsakit_oid';

    protected $guarded = [];

    public $timestamps = false;
}
