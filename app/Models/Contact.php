<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [

        'name',
        'organization_id',
        'position_id',
        'service_id',
        'location_id',
        'phone',
        'short_phone',
        'phone_code',
        'email',
        'description',
    ];

    public function organization()
    {
        return $this->belongsTo(Organization::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    //Query Scope
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('name', 'LIKE', "%" . $search . "%")
                ->orWhere('phone', 'LIKE', "%" . $search . "%")
                ->orWhere('short_phone', 'LIKE', "%" . $search . "%")
                ->orWhere('phone_code', 'LIKE', "%" . $search . "%")
                ->orWhere('email', 'LIKE', "%" . $search . "%")
                ->orWhere('description', 'LIKE', "%" . $search . "%")
                ->orWhereHas('organization', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%" . $search . "%");
                })
                ->orWhereHas('position', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%" . $search . "%");
                })
                ->orWhereHas('service', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%" . $search . "%");
                })
                ->orWhereHas('location', function ($query) use ($search) {
                    $query->where('name', 'LIKE', "%" . $search . "%");
                });
        });
    }
}
