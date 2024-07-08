<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Dentist extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    
    public $incrementing = false;
    protected $fillable = [
        'dentistID',
        'name',
        'email',
        'password',
        'age',
        'gender',
        'phoneNumber',
        'role',
        'userstatus',
        'is_admin',
    ];
    protected $primaryKey = 'dentistID';
}
