<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlsStrct extends Model
{
    use HasFactory;

    protected $table = 'public.sls_strct';

    protected $keyType = 'string';

    protected $primaryKey = 'sls_oid';
}
