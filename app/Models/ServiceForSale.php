<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceForSale extends Model
{
    use HasFactory;

    protected $table = 'services_for_sale';

    protected $fillable = [
        'title',
        'price'
    ];
}
