<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cycle extends Model
{
    use SoftDeletes;

    protected $table = 'cycles';

    protected $fillable = [
        'start_date',
        'end_date',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function membersAdmitted()
    {
        return $this->hasMany(Member::class, 'admission_cycle_id');
    }

    public function branches()
    {
        return $this->hasMany(Branch::class);
    }
}
