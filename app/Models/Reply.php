<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $column, mixed $value)
 * @method static create(array $formFields)
 * @method static find(integer $id)
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $user_id
 * @property string $message
 * @property string $files
 */
class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['redirect_id', 'message', 'files'];
}
