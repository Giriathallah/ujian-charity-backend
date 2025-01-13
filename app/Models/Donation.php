<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use CloudinaryLabs\CloudinaryLaravel\MediaAlly;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Donation extends Model
{
    use HasFactory;

    protected $table = 'donations';
    protected $fillable = [
        'title',
        'description',
        'target_amount',
        'collected_amount',
        'start_date',
        'end_date',
        'status',
        'image_path',
        'category',
        'visibility',
        'created_by',

    ];

    protected $casts = [
        'target_amount' => 'decimal:2',
        'collected_amount' => 'decimal:2',
        'start_date' => 'datetime',
        'end_date' => 'datetime',
        'visibility' => 'boolean',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    // Accessor untuk mendapatkan URL gambar
    public function getImageUrlAttribute()
    {
        return $this->image_path ? asset('images/' . $this->image_path) : null;
    }


    // Accessor untuk mendapatkan URL gambar
    // public function getImageUrlAttribute()
    // {
    //     return $this->image_path ? Storage::url('images/' . $this->image_path) : null;
    // }

}