<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $formFields)
 */
class Ticket extends Model
{
    use HasFactory;

    protected $fillable = ['temat', 'opis', 'termin', 'priorytet'];

}
