<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'members';

    protected $fillable = [
        'document_number',
        'document_extension',
        'first_name',
        'last_name',
        'career',
        'phone_number',
        'birth_date',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function contributions()
    {
        return $this->hasMany(MemberContribution::class);
    }

    public function cycles()
    {
        return $this->belongsToMany(Cycle::class, 'cycle_members')
            ->using(CycleMember::class)
            ->withPivot(['id', 'deleted_at'])
            ->withTimestamps();
    }

    public function branches()
    {
        return $this->belongsToMany(Branch::class, 'branch_members')
            ->using(BranchMember::class)
            ->withPivot(['id', 'deleted_at'])
            ->withTimestamps();
    }

    public function directives()
    {
        return $this->belongsToMany(Directive::class, 'directive_members')
            ->using(DirectiveMember::class)
            ->withPivot(['id', 'is_leader', 'deleted_at'])
            ->withTimestamps();
    }

    public function user()
    {
        return $this->hasOne(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Accessors
    |--------------------------------------------------------------------------
    */

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
