<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrWorkGroup extends Model
{
    use HasFactory;

    protected $table = "hris.hr_work_group";

    protected $keyType = 'string';

    protected $primaryKey = 'wg_id';
}
