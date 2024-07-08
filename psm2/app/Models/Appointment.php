<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'appointmentID',
        'dentistID',
        'patientID',
        'treatmentID',
        'status',
        'date',
        'time',
    ];
    protected $primaryKey = 'appointmentID';
}
