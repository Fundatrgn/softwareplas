<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Patient extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'birth_date',
        'gender',
        'notes',
        'kvkk_approved',
        'username',
        'password',
        'portal_credentials_sent_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'birth_date' => 'date',
        'kvkk_approved' => 'boolean',
        'password' => 'hashed',
        'portal_credentials_sent_at' => 'datetime',
    ];

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function testAssignments()
    {
        return $this->hasMany(TestAssignment::class);
    }

    public function hasPortalAccess(): bool
    {
        return ! empty($this->username) && ! empty($this->password);
    }
}
