<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chicago extends Model
{
    use HasFactory;

    protected $table = 'chicago_crime';
}
