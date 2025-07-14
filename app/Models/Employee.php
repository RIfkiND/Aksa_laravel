<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasUuids;
    protected $table = 'employees';

    protected $keyType = 'string';

    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'image',
        'name',
        'phone',
        'position',
        'division',
    ];

    public function scopeFilterByDivision($query, $division)
    {
        if ($division) {
            return $query->where('division', $division);
        }
        return $query;
    }

    public function scopeFilterByName($query, $name)
    {
        if ($name) {
            return $query->where('name', 'like', '%' . $name . '%');
        }
        return $query;
    }

    public function Divisions()
    {
        return $this->belongsTo(Division::class , 'division' , 'id');
    }
}
