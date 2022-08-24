<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRAbsMaster extends Model
{
    use HasFactory;

    protected $table = 'public.hrabs_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrabs_oid';
}
