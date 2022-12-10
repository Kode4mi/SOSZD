<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @method static where(string $column, mixed $value)
 * @method static find(int $id)
 * @method static sortable()
 * @method static whereNotIn(string $column, mixed $value)
 * @method static create(array $formFields)
 * @method static whereNot(string $column, mixed $value)
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $role
 * @property string $email
 * @property string $password
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role',
    ];

    public array $sortable = ['first_name', 'last_name', 'role', 'email'];

    public function scopeFilter($query, array $filters): void
    {
        if ($filters['search'] ?? false){
            $query->where('first_name', 'like', '%' . request('search') . '%')
                ->orWhere('last_name', 'like', '%' . request('search') . '%')
                ->orWhere('role', 'like', '%' . request('search') . '%')
                ->orWhere('email', 'like', '%' . request('search') . '%');
        }
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function redirects() : HasOneOrMany
    {
        return $this->hasMany(Redirect::class);
    }

}
