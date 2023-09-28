<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Ticket extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable = [
        'tracking_id',
        'title',
        'description',
        'user_id',
        'status',
        'category_id',
        'priority_id',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $category = Category::find($model->category_id);
            $model->tracking_id = Str::slug($category->name) . Str::random();
        });
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return BelongsTo
     */
    public function priority(): BelongsTo
    {
        return $this->belongsTo(Priority::class);
    }

    /**
     * @return HasMany
     */
    public function replies(): HasMany
    {
        return $this->hasMany(TicketReply::class, 'ticket_id');
    }
}
