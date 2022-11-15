<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
