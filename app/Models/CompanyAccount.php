<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'ejercicio',
        'facturacion',
        'resultado_neto',
        'empleados',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
