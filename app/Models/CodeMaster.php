<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeMaster extends Model
{
    use HasFactory;

    protected $table = 'public.code_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'code_oid';

    protected $guarded = [];

    public $timestamps = false;
}
