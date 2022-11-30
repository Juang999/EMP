<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrgDirMstr extends Model
{
    use HasFactory;

    protected $table = 'public.orgdir_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'dir_oid';

    protected $guarded = [];

    public $timestamps = false;

    // protected static function newFactory()
    // {
    //     return \Modules\PIM\Database\factories\OrgDirMstrFactory::new();
    // }
}
