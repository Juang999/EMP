<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HROrganisasi extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_organisasi';

    protected $keyType = 'string';

    protected $primaryKey = 'hrorg_oid';

    protected $guarded = [];

    public $timestamps = false;
}
