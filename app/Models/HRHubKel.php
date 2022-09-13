<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRHubKel extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_hub_kel';

    protected $keyType = 'string';

    protected $primaryKey = 'hrhub_id';

    public function HRKeluarga()
    {
        return $this->hasMany(HRKeluarga::class, 'hrhub_id', 'hrkel_hub_id');
    }
}
