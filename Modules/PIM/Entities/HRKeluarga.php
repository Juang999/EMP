<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HRKeluarga extends Model
{
    use HasFactory;

    protected $table = 'hris.hr_keluarga';

    protected $keyType = 'string';

    protected $primaryKey = 'hrkel_oid';

    protected $guarded = [];

    public $timestamps = false;

    public function HRHubKel()
    {
        return $this->belongsTo(HRHubKel::class, 'hrkel_hub_id', 'hrhub_id');
    }
}
