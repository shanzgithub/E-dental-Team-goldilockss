<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DigitalDocument extends Model
{
    use HasFactory;

    protected $fillable = [
        'dentistID',
        'patientID',
        'name',
        'file',
        'type',
    ];
}
