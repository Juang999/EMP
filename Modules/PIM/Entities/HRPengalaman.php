<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRPengalaman extends Model
{
    use HasFactory;

    use HasFactory;

    protected $table = 'hris.hr_pengalaman';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpeng_oid';

    protected $guarded = [];

    public $timestamps = false;
}
