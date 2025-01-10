<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    protected $fillable = ['title', 'views', 'youtube_id', 'thumbnail', 'status'];

    public const STATUS_PENDING = 'pending';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    public function Pending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    public function Approved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    public function Rejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }
}
