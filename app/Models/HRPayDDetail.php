<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPayDDetail extends Model
{
    use HasFactory;

    protected $table = 'public.hrpayd_det';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpayd_oid';
}
