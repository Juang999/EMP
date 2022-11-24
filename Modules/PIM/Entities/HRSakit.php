<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRSakit extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_sakit';

    protected $keyType = 'string';

    protected $primaryKey = 'hrsakit_oid';

    protected $guarded = [];

    public $timestamps = false;
}
