<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRHirarki extends Model
{
    use HasFactory;

    protected $table = 'hris.hrhirarki';

    protected $keyType = 'integer';

    protected $primaryKey = 'id';

    protected $guarded = [];

    public $timestamps = false;
}
