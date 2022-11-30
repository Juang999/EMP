<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrgDivMstr extends Model
{
    use HasFactory;

    protected $table = 'public.orgdiv_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'div_oid';

    protected $guarded = [];

    public $timestamps = false;

    // protected static function newFactory()
    // {
    //     return \Modules\PIM\Database\factories\OrgDivMstrFactory::new();
    // }
}
