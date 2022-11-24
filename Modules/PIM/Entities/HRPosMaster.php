<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRPosMaster extends Model
{
    use HasFactory;

    protected $table = 'hris.hrpos_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpos_oid';
}
