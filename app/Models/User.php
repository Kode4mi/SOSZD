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
 * @method static where(string $column, string $value)
 * @method static find(int $id)
 * @method static sortable()
 * @property string $password
 * @property integer $id
 * @property string $email
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function redirects() : HasOneOrMany
    {
        return $this->hasMany(Redirect::class);
    }

}
