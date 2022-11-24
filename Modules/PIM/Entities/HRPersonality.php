<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRPersonality extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_personality';

    protected $keyType = 'string';

    protected $primaryKey = 'hr_persnlt_oid';

    protected $guarded = [];

    public $timestamps = false;
}
