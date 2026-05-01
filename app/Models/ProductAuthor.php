<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductAuthor extends Model
{
    use SoftDeletes;

    protected $table = 'product_authors';

    protected $fillable = [
        'product_id',
        'member_id',
        'author_percentage'
    ];

    protected $casts = [
        'author_percentage' => 'decimal:2',
    ];

    public $incrementing = true;

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function author()
    {
        return $this->belongsTo(Member::class);
    }
}
