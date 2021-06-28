<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Carbon\Carbon;

class Article extends Model
{
    protected $fillable = [
        'title',
        'body',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo('App\User');
    }

    public function likes(): BelongsToMany
    {
        return $this->belongsToMany('App\User', 'likes')->withTimestamps();
    }

    public function isLikedBy(?User $user): bool
    {
        return $user
            ? (bool)$this->likes->where('id', $user->id)->count()
            : false;
    }

    public function getCountLikesAttribute(): int
    {
        return $this->likes->count();
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    public function tasks(): HasMany
    {
        return $this->hasMany('App\Task')->withTimestamps();
    }

    public function folders(): HasMany
    {
        return $this->hasMany('App\Folder')->withTimestamps();
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['created_at'])->format('Y/m/d');
    }
}
