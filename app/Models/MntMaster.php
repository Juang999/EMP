<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MntMaster extends Model
{
    use HasFactory;

    protected $table = 'hris.mnt_mstr';

    protected $primaryKey = 'mnt_code';
}
