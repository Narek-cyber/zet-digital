<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'website_id',
        'title',
        'description',
        'email_sent'
    ];

    /**
     * @return BelongsTo
     */
    public function website()
    {
        return $this->belongsTo(Website::class);
    }
}
