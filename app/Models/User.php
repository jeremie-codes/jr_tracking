<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $email
 * @property Carbon|null $email_verified_at
 * @property string|null $password
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $role
 * @property string|null $phone_number
 * @property string|null $address
 * @property string|null $gender
 * @property Carbon|null $date_of_birth
 * @property string|null $avatar
 * @property bool $is_active
 *
 * @property Collection|Shop[] $shops
 *
 * @package App\Models
 */
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    protected $table = 'users';

    protected $casts = [
        'email_verified_at' => 'datetime',
        'is_active' => 'bool',
        'tasks'=> 'array',
    ];

    protected $hidden = [
        'password',
        'remember_token'
    ];

    protected $fillable = [
        'name',
        'email',
        'email_verified_at',
        'password',
        'remember_token',
        'role',
        'avatar',
        'tasks',
        'is_active'
    ];
}
