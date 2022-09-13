<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UseAset extends Model
{
    use HasFactory;

    protected $table = 'akses.use_aset';

    protected $keyType = 'string';

    protected $primaryKey = 'use_aset_oid';

    protected $guarded = [];

    public $timestamps = false;
}
