<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRPendidikan extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_pendidikan';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpend_oid';

    protected $guarded = [];

    public $timestamps = false;
}
