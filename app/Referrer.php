<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property string $token
 */
class Referrer extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $fillable = ['name', 'email', 'token'];
}
