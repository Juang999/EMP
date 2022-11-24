<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRPrestasi extends Model
{
    use HasFactory;

    protected $fillable = [];

    protected $table = 'hris.hr_prestasi';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpres_oid';

    protected $guarded = [];

    public $timestamps = false;
}
