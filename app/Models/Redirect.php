<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneOrMany;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @method static where(string $column, mixed $value)
 * @method static create(array $formFields)
 * @method static find(integer $id)
 *
 * @property integer $id
 * @property integer $ticket_id
 * @property integer $user_id
 * @property boolean $read
 */
class Redirect extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','ticket_id','read','active','slug'];

    public function ticket() : Relation
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user() : Relation
    {
        return $this->belongsTo(User::class);
    }

    public function replay() : HasOneOrMany
    {
        return $this->hasOne(Reply::class);
    }

    public function hasReply() : bool {
        $reply = Reply::where("redirect_id", $this->id)->get();
        if($reply->isEmpty()) {
            return false;
        }
        return true;
    }
}
