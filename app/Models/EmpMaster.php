<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmpMaster extends Model
{
    use HasFactory;

    protected $table = 'public.emp_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'emp_oid';
}
