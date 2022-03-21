<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * App\Models\Task
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $status_id
 * @property int $created_by_id
 * @property int|null $assigned_to_id
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property-read \App\Models\User $creator
 * @property-read \App\Models\User|null $executor
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Label[] $labels
 * @property-read int|null $labels_count
 * @property-read \App\Models\TaskStatus $status
 */
class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'status_id', 'created_by_id', 'assigned_to_id'];

    public function status(): BelongsTo
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_id');
    }

    public function executor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to_id');
    }

    public function labels(): BelongsToMany
    {
        return $this->belongsToMany(Label::class);
    }
}
