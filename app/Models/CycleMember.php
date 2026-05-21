<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class CycleMember extends Pivot
{
    use SoftDeletes;

    protected $table = 'cycle_members';

    protected $fillable = [
        'cycle_id',
        'member_id',
    ];

    public $incrementing = true;

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
