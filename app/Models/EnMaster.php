<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnMaster extends Model
{
    use HasFactory;

    protected $table = 'public.en_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'en_oid';
}
