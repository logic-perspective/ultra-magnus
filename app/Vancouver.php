<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vancouver extends Model
{
    use HasFactory;

    protected $table = 'vancouver_crime';
}
