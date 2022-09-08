<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HrStatusMaster extends Model
{
    use HasFactory;

    protected $table = 'hris.hrstatus_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrstatus_oid';
}
