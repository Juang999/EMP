<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKurangBayar extends Model
{
    use HasFactory;

    protected $table = 'public.hrkurang_bayar';

    protected $keyType = 'string';

    protected $primaryKey = 'hrkurang_code';
}
