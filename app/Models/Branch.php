<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Branch extends Model
{
    use SoftDeletes;

    protected $table = 'branches';

    protected $fillable = [
        'name',
        'branch_number',
        'cycle_id',
    ];

    protected $casts = [
        'cycle_id' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function cycle()
    {
        return $this->belongsTo(Cycle::class);
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'branch_members')
            ->using(BranchMember::class)
            ->withPivot(['id', 'deleted_at'])
            ->withTimestamps();
    }
}
