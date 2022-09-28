<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRHobbies extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_hobbies';

    protected $keyType = 'string';

    protected $primaryKey = 'hr_hobbies_oid';

    protected $guarded = [];

    public $timestamps = false;
}
