<?php

namespace Modules\Recruitment\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RekrutPengajuan extends Model
{
    use HasFactory;

    protected $table = "hris.rekrut_pengajuan";

    protected $keyType = 'string';

    protected $primaryKey = 'pgj_code';

    protected $guarded = [];

    public $timestamps = false;

    // protected static function newFactory()
    // {
    //     return \Modules\Recruitment\Database\factories\RekrutPengajuanFactory::new();
    // }
}
