<?php

namespace App\Models;

use App\Enums\CycleState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'cycles';

    protected $fillable = [
        'start_date',
        'end_date',
        'state',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'state' => CycleState::class,
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function members()
    {
        return $this->belongsToMany(Member::class, 'cycle_members')
            ->using(CycleMember::class)
            ->withPivot(['id', 'deleted_at'])
            ->withTimestamps();
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
