<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HROrganisasi extends Model
{
    use HasFactory;

    protected $table = 'public.hr_organisasi';

    protected $keyType = 'string';

    protected $primaryKey = 'hrorg_oid';
}
