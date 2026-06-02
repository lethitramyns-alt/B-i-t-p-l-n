<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Destination extends Model
{
    protected $fillable = [
        'name', 'slug', 'region_id', 'destination_type_id',
        'description', 'tips', 'address',
        'latitude', 'longitude', 'image', 'gallery',
        'popularity', 'is_featured'
    ];

    protected $casts = [
        'gallery' => 'array',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->name);
            }
        });
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function destinationType()
    {
        return $this->belongsTo(DestinationType::class);
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }

    public function isFavoritedBy($userId)
    {
        return $this->favorites()->where('user_id', $userId)->exists();
    }

    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/default-destination.jpg');
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->where('name', 'like', "%{$keyword}%")
                     ->orWhere('description', 'like', "%{$keyword}%")
                     ->orWhere('address', 'like', "%{$keyword}%");
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePopular($query)
    {
        return $query->orderBy('popularity', 'desc');
    }

    public function getRelated($limit = 4)
    {
        return static::where('id', '!=', $this->id)
            ->where(function($q) {
                $q->where('region_id', $this->region_id)
                  ->orWhere('destination_type_id', $this->destination_type_id);
            })
            ->orderBy('popularity', 'desc')
            ->limit($limit)
            ->get();
    }
}
