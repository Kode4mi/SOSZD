<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Kyslik\ColumnSortable\Sortable;

/**
 * @method static create(array $formFields)
 * @method static latest()
 * @method static sortable()
 * @method static where(string $column, string $value)
 * @method static find(mixed $ticket_id)
 * @property string $deadline
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

    public function redirects() : HasOneOrMany
    {
        return $this->hasOne(Redirect::class);
    }

    public function dateFormat() : String {
        $date=date_create($this->deadline);
        $month = "miesiąc";
        $today = new DateTime("today");

        $diff = $today->diff( $date );
        $diffDays = (integer)$diff->format( "%R%a" );

        for($i = 1; (string)$i <= date_format($date, "m"); $i++) {
            $month = __("app.month.$i");
        }

        return match ($diffDays) {
            0 => "Dzisiaj o " . date_format($date, "H:i"),
            -1 => "Wczoraj o " . date_format($date, "H:i"),
            +1 => "Jutro o " . date_format($date, "H:i"),
            default => date_format($date, "d ") . $month . date_format($date, " y") . "r.",
        };
    }

}
