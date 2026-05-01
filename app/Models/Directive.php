<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Directive extends Model
{
    use SoftDeletes;

    protected $table = 'directives';

    protected $fillable = [
        'name'
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function members()
    {
        return $this->belongsToMany(Member::class, 'directive_members')
            ->using(DirectiveMember::class) // pivote custom
            ->withPivot(['id', 'is_leader', 'deleted_at'])
            ->withTimestamps();
    }
}
