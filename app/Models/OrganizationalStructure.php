<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationalStructure extends Model
{
     protected $fillable = [
        'title',
        'image',
        'order',
    ];
}
