<?php

namespace App\Models;

use App\Enums\MovementType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TransactionCategory extends Model
{
    use SoftDeletes;

    protected $table = 'transaction_categories';

    protected $fillable = [
        'name',
        'description',
        'type',
        'is_protected'
    ];

    protected $casts = [
        'is_protected' => 'boolean',
        'type' => MovementType::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
