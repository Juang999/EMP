<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRPengalaman extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_pengalaman';

    protected $keyType = 'string';

    protected $primaryKey = 'hrpeng_oid';

    protected $guarded = [];

    public $timestaps = false;
}
