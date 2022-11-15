<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DptMstr extends Model
{
    use HasFactory;

    protected $table = "public.dpt_mstr";

    protected $keyType = 'string';

    protected $primaryKey = 'dpt_oid';

    protected $guarded = [];

    public $timestamps = false;
}
