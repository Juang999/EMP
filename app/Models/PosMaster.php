<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosMaster extends Model
{
    use HasFactory;

    protected $table = 'publi.pos_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpos_oid';
}
