<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPendidikanNon extends Model
{
    use HasFactory;

    protected $table = 'public.hr_pendidikan_non';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpendn_oid';
}
