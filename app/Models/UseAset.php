<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseAset extends Model
{
    use HasFactory;

    protected $table = 'public.use_aset';

    protected $keyType = 'string';

    protected $primaryKey = 'use_aset_oid';
}
