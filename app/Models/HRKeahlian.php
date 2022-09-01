<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKeahlian extends Model
{
    use HasFactory;

    protected $table = 'public.hr_keahlian';

    protected $keyType = 'string';

    protected $primaryKey = 'hrahli_oid';
}
