<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRPendidikanNon extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_pendidikan_non';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpendn_oid';

    protected $guarded = [];

    public $timestamps = false;
}
