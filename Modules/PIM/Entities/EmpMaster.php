<?php

namespace Modules\PIM\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class EmpMaster extends Model
{
    use HasFactory;

    protected $table = 'public.emp_mstr';

    protected $keyType = 'string';

    protected $primaryKey = 'emp_oid';

    protected $guarded = [];

    public $timestamps = false;

    protected $hidden = ['emp_photo'];
}
