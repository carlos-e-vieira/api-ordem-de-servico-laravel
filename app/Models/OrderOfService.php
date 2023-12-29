<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderOfService extends Model
{
    use HasFactory;

    protected $table = 'orders_of_service';

    protected $fillable = [
        'user_id',
        'customer_id',
        'service_id',
        'status',
    ];

    public function user(): mixed
    {
        return $this->belongsTo(User::class);
    }

    public function customer(): mixed
    {
        return $this->belongsTo(Customer::class);
    }

    public function service(): mixed
    {
        return $this->belongsTo(Service::class);
    }
}
