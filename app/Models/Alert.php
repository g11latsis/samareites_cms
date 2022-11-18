<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasFactory;
    protected $fillable = [
        'fromid',
        'from',
        'to1',
        'to2',
        'to3',
        'desc1',
        'desc2',
        'desc3',
        'trashedbyadmin',
        'trashedbyra',
        'trashedbyuser',
        'seenbyadmin',
        'seenbyra',
        'seenbyuser',
    ];
}
