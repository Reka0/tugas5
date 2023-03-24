<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';
    protected $guarded = 'id';

    public function category() {
        return $this->belongsTo(category::class);
    }
}
