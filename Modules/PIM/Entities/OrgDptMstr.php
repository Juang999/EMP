<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrgDptMstr extends Model
{
    use HasFactory;

    protected $table = 'public.orgdpt_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'dpt_oid';

    protected $guarded = [];

    public $timestamps = false;

    // protected static function newFactory()
    // {
    //     return \Modules\PIM\Database\factories\OrgDptMstrFactory::new();
    // }
}
