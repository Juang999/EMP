<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRKontrak extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_kontrak';

    protected $keyType = 'string';

    protected $primaryKey = 'hrkontrak_oid';

    protected $guarded = [];

    public $timestamps = false;
}
