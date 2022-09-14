<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPeriodeMaster extends Model
{
    use HasFactory;

    protected $table = 'hris.hrperiode_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrperiode_code';

    protected $guarded = [];

    public $timestamps = false;
}
