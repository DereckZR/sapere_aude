<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock_quantity',
        'author_comission_percentage'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock_quantity' => 'integer',
        'author_comission_percentage' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function authors()
    {
        return $this->belongsToMany(Member::class, 'product_authors')
            ->using(ProductAuthor::class)
            ->withPivot(['id', 'author_percentage', 'deleted_at'])
            ->withTimestamps();
    }
}
