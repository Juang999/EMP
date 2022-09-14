<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKontrak extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_kontrak';

    protected $keyType = 'string';

    protected $primaryKey = 'hrkontrak_oid';

    protected $guarded = [];

    public $timestamps = false;
}
