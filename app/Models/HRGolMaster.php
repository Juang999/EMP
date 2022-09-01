<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRGolMaster extends Model
{
    use HasFactory;

    protected $table = 'hris.hrgol_mstr';

    protected $primaryKey = 'hrgol_id';
}
