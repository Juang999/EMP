<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrJabatanMaster extends Model
{
    use HasFactory;

    protected $table = 'hris.hrjabatan_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrjbt_oid';

}
