<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TconfGroup extends Model
{
    use HasFactory;

    protected $table = 'public.tconfgroup';

    protected $primaryKey = 'groupid';
}
