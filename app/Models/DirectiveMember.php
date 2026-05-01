<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class DirectiveMember extends Pivot
{
    use SoftDeletes;

    protected $table = 'directive_members';

    protected $fillable = [
        'directive_id',
        'member_id',
        'is_leader',
    ];

    public $incrementing = true;

    protected $casts = [
        'is_leader' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function directive()
    {
        return $this->belongsTo(Directive::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
