<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HRKeluarga extends Model
{
    use HasFactory;

    protected $table = 'public.hr_keluarga';

    protected $keyType = 'string';

    protected $primaryKey = 'hrkel_oid';

    protected $guarded = [];

    public $timestamps = false;

    public function HRHubKel()
    {
        return $this->belongsTo(HRHubKel::class, 'hrkel_hub_id', 'hrhub_id');
    }
}
