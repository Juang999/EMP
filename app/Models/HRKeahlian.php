<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKeahlian extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_keahlian';

    protected $keyType = 'string';

    protected $primaryKey = 'hrahli_oid';

    protected $guarded = [];

    public $timestamps = false;
}
