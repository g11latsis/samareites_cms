<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'fname',
        'mname',
        'dob',
        'bloodtype',
        'edu',
        'spec',
        'attr',
        'lvl',
        'prof',
        'gen',
        'vat',
        'idno',
        'passport',
        'address',
        'postal',
        'contact',
        'tele',
        'email',
        'active',
        'password',
        'img',
        'dor',
        'doo',
        'school',
        'register',
        'city',
        'regno',
        'languages',
        'hours',
        'awards',
        'penalties',
        'cv',
        'region',
        'part_status',
    ];
}
