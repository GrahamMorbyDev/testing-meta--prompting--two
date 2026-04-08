<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable(['user_id', 'name', 'quantity', 'notes', 'completed'])]
class ShoppingItem extends Model
{
    use HasFactory;

    protected $casts = [
        'quantity' => 'integer',
        'completed' => 'boolean',
    ];

    /**
     * The user that owns the shopping item.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Toggle the completed state of the item and persist.
     */
    public function toggleCompleted(): bool
    {
        $this->completed = ! (bool) $this->completed;
        return $this->save();
    }
}
