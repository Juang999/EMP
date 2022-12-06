<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrgSecMstr extends Model
{
    use HasFactory;

    protected $table = 'public.orgsect_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'sect_oid';

    protected $guarded = [];

    public $timestamps = false;

    // protected static function newFactory()
    // {
    //     return \Modules\PIM\Database\factories\OrgSecMstrFactory::new();
    // }
}
