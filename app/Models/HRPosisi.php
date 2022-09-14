<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPosisi extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_posisi';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpos_oid';

    protected $guarded = [];

    public $timestamps = false;
}
