<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'regno',
        'date',
        'type',
        'detail',
        'veh',
        'vehtype',
        'driver',
        'desc',
        'locus',
        'strthrs',
        'endhrs',
        'ttlhrs',
        'parts',
        'parthrs',
        'region',
        'ra_id',
    ];
}
