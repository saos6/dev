<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author_id',
        'page',
        'subtitle',
        'price'
    ];

    public function author() {
      return $this->belongsTo(Author::class);
      // return $this->belongsToMany(Author::class,'author_id');
      // return $this->hasOne(Author::class);
      // return $this->belongsToMany(Author::class, 'books')->using(BookAuthor::class);
    }
    public function authors()
    {
        return $this->belongsToMany(Author::class);
    }
}
