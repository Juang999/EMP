<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HREditGaji extends Model
{
    use HasFactory;

    protected $table = 'public.hredit_gaji';

    protected $keyType = 'string';

    protected $primaryKey = 'hredit_oid';
}
