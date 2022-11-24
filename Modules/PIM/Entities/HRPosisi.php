<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRPosisi extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_posisi';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpos_oid';

    protected $guarded = [];

    public $timestamps = false;
}
