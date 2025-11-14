<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'fecha',
        'tipo',
        'descripcion',
        'borme_pdf',
    ];

    protected $casts = [
        'fecha' => 'date',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
