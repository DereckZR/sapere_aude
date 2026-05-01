<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BranchMember extends Model
{
    use SoftDeletes;

    protected $table = 'branch_members';

    protected $fillable = [
        'branch_id',
        'member_id',
    ];

    public $incrementing = true;

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function branch()
    {
        return $this->belongsTo(Branch::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
