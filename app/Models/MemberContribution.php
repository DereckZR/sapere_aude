<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MemberContribution extends Model
{
    use SoftDeletes;

    protected $table = 'member_contributions';

    protected $fillable = [
        'member_id',
        'cycle_id',
        'contribution_date',
        'contribution_amount',
    ];

    protected $casts = [
        'contribution_date' => 'date',
        'contribution_amount' => 'decimal:2',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
