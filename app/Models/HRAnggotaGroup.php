<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRAnggotaGroup extends Model
{
    use HasFactory;

    protected $table = 'public.hranggota_group';

    protected $keyType = 'string';

    protected $primaryKey = 'hrangg_oid';
}
