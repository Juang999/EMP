<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrgUSectMstr extends Model
{
    use HasFactory;

    protected $table = 'public.orgusec_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'usec_oid';

    protected $guarded = [];

    public $timestamps = false;

    // protected static function newFactory()
    // {
    //     return \Modules\PIM\Database\factories\OrgUSectMstrFactory::new();
    // }
}
