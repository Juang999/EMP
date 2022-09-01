<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrgsMaster extends Model
{
    use HasFactory;

    protected $table = 'public.orgs_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'orgs_oid';
}
