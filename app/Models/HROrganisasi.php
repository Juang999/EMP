<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HROrganisasi extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_organisasi';

    protected $keyType = 'string';

    protected $primaryKey = 'hrorg_oid';

    protected $guarded = [];

    public $timestamps = false;
}
