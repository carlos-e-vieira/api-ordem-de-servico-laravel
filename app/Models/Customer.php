<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'document_type',
        'document_number',
        'email',
        'phone',
        'company_name',
    ];

    public function orderOfService(): mixed
    {
        return $this->hasMany(OrderOfService::class);
    }
}
