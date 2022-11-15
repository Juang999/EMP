<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UseAset extends Model
{
    use HasFactory;

    protected $table = 'akses.use_aset';

    protected $keyType = 'string';

    protected $primaryKey = 'use_aset_oid';

    protected $guarded = [];

    public $timestamps = false;
}
