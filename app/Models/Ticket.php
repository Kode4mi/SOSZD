<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @method static create(array $formFields)
 * @method static latest()
 * @method static sortable()
 * @method static where(string $column, string $value)
 */
class Ticket extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['title', 'description', 'deadline', 'priority', 'sender_id', 'active'];

    public array $sortable = ['title', 'description', 'deadline', 'priority'];

    public function scopeFilter($query, array $filters): void
    {
        if ($filters['search'] ?? false) {
            $query->where('title', 'like', '%' . request('search') . '%')
                ->orWhere('description', 'like', '%' . request('search') . '%')
                ->orWhere('deadline', 'like', '%' . request('search') . '%');
        }
    }


}
