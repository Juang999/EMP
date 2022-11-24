<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRKeahlian extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_keahlian';

    protected $keyType = 'string';

    protected $primaryKey = 'hrahli_oid';

    protected $guarded = [];

    public $timestamps = false;
}
