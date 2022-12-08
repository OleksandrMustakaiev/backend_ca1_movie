<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'year', 'category', 'description', 'rating', 'image', 'production_company_id'];
    //protected $guarded = [];

    public function production_company()
    {
        return $this->belongsTo(ProductionCompany::class);
    }

    public function directors()
    {
        return $this->belongsToMany(Director::class)->withTimestamps();
    }
}