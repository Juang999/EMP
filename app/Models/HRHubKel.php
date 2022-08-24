<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRHubKel extends Model
{
    use HasFactory;

    protected $table = 'public.hr_hub_kel';

    protected $keyType = 'string';

    protected $primaryKey = 'hrhub_id';
}
