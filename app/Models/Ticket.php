<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

/**
 * @method static create(array $formFields)
 * @method static latest()
 * @method static sortable()
 */
class Ticket extends Model
{
    use HasFactory, Sortable;

    protected $fillable = ['temat', 'opis', 'termin', 'priorytet'];

    public array $sortable = ['temat', 'opis', 'termin', 'priorytet'];

}
