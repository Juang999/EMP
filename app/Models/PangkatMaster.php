<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PangkatMaster extends Model
{
    use HasFactory;

    protected $table = 'public.pangkat_mstr';

    protected $primaryKey = 'pangkat_id';
}
