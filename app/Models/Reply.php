<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;

/**
 * @method static where(string $column, mixed $value)
 * @method static create(array $formFields)
 * @method static find(integer $id)
 *
 * @property integer $id
 * @property integer $redirect_id
 * @property string $message
 * @property string $files
 */
class Reply extends Model
{
    use HasFactory;

    protected $fillable = ['redirect_id', 'message', 'files', 'slug'];

    public function redirect(): Relation
    {
        return $this->belongsTo(Redirect::class);
    }

    // Tablica z załącznikami z odpowiedzi
    public function getFiles(): array
    {
        $files = explode(";", $this->files);
        $count = count($files);

        unset($files[$count - 1]);

        return $files;
    }

}
