<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPendidikan extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_pddk_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpend_oid';
}
