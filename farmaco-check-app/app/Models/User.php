<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

/**
 * Class User
 *
 * This class represents the User model in the system. It extends the `Authenticatable`
 * class from Laravel, meaning it can be used for authentication purposes. The model
 * also implements the `HasRoles` trait from the Spatie package to handle roles and
 * permissions.
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    /** 
     * The traits that should be used by this class.
     *
     * @var array<int, string>
     * @uses HasFactory<\Database\Factories\UserFactory>
     * @uses Notifiable
     * @uses HasRoles
     */
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * These are the attributes that are allowed to be assigned in bulk
     * through methods like `create` or `update`. This helps protect
     * against mass-assignment vulnerabilities.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',       // User's full name
        'email',      // User's email address
        'password',   // User's password
        'crm',        // CRM (likely for healthcare or similar professional)
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * These attributes will be hidden when the model is converted to an array or JSON.
     * This is commonly used to hide sensitive information like passwords and remember tokens.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',       // Hides password when serializing the model
        'remember_token', // Hides remember token for security
    ];

    /**
     * Get the attributes that should be cast.
     *
     * This method allows attributes to be cast to specific types. 
     * For example, the `email_verified_at` field is cast to a `datetime` object,
     * and the `password` field is cast to be `hashed`, which helps in maintaining
     * proper data types and security.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',  // Casts to datetime format
            'password' => 'hashed',             // Ensures password is hashed when retrieved
        ];
    }
}
