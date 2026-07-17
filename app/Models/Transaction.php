<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;

    protected $table = 'transactions';

    protected $fillable = [
        'description',
        'amount',
        'transaction_date',
        'is_cash',
        'transaction_category_id',
        'responsible_member_id',
        'cycle_id',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
        'transaction_date' => 'datetime',
        'is_cash' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function transactionCategory()
    {
        return $this->belongsTo(TransactionCategory::class);
    }

    public function responsibleMember()
    {
        return $this->belongsTo(Member::class, 'responsible_member_id');
    }

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }
}
