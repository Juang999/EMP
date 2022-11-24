<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRHobbies extends Model
{
    use HasFactory;
    
    protected $table = 'hris.hr_hobbies';

    protected $keyType = 'string';

    protected $primaryKey = 'hr_hobbies_oid';

    protected $guarded = [];

    public $timestamps = false;
}
