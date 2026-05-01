<?php

namespace App\Models;

use App\Enums\MovementType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InventoryMovement extends Model
{
    use SoftDeletes;

    protected $table = 'inventory_movements';

    protected $fillable = [
        'type',
        'quantity',
        'reason',
        'reason_details',
        'movement_date',
        'product_id',
        'transaction_id',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'movement_date' => 'datetime',
        'type' => MovementType::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}
