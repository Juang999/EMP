<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPersonality extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_personality';

    protected $keyType = 'string';

    protected $primaryKey = 'hr_persnlt_oid';

    protected $guarded = [];

    public $timestamps = false;
}
