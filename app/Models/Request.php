<?php

namespace App\Models;

use App\Http\Controllers\ItemsController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_user',
        'quantity_user',
        'user_remark',
        'request_by',
        'requested_timestamp',
        'type',
        'status',
        'item_id',
        'quantity',
        'sm_remark',
        'store_manager',
        'store_manager_timestamp',
        'isActive',
    ];

    public function getTypeRequestAttribute()
    {
        $status = [
            1 =>'Request',
            2 => 'Return',
            // Add more roles as needed
        ];

        return $status[$this->attributes['type']] ?? 'Unknown Status';
    }

    public function requestedByUser()
    {
        return $this->belongsTo(User::class, 'request_by', 'id');
    }

    public function getItemById()
    {
        return $this->belongsTo(Item::class, 'item_user', 'id');
    }

    public function getItemNameById()
    {
        return $this->belongsTo(Item::class, 'item_id', 'id');
    }

    public function storeManagerAttributes()
    {
        return $this->belongsTo(User::class, 'store_manager', 'id');
    }

    public function getStatusRequestAttribute()
    {
        $status = [
            0 =>'user_request',
            1 => 'sm_processing',
            2 => 'sm_accepted',
            3 => 'sm_rejected',
            // Add more roles as needed
        ];

        return $status[$this->attributes['status']] ?? 'Unknown Status';
    }
    public function getRequestProcessAttribute()
    {
        $status = [
            0 =>'Process',
            1 => 'Processing',
            2 => 'Processed',
            3 => 'Processed',
            // Add more roles as needed
        ];

        return $status[$this->attributes['status']] ?? 'Unknown Status';
    }

}
