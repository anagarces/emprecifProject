<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDirector extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'nombre',
        'cargo',
        'fecha_nombramiento',
        'fecha_cese',
    ];

    protected $casts = [
        'fecha_nombramiento' => 'date',
        'fecha_cese' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
