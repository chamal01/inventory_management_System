<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'po_no',
        'product_id',
        'brand_id',
        'item_name',
        'condition',
        'condition_updated_by',
        'condition_updated_timestamp',
        'items_remaining',
        'lower_limit',
        'owner',
        'created_by',
        'isActive',
        'created_time_stamp',
    ];

    public function createdByUser()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function conditionUpdatedByUser()
    {
        return $this->belongsTo(User::class, 'condition_updated_by', 'id');
    }
    public function ownerUser()
    {
        return $this->belongsTo(User::class, 'owner', 'id');
    }
    public function categoryData()
    {
        return $this->belongsTo(Product::class, 'product_id')->select('id', 'product_name', 'category_id');
    }

    public function productData()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function brandData()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    public function getIsCondtionItemAttribute()
    {
        $status = [
            1 => 'Working',
            2 => 'Damaged',
            // Add more roles as needed
        ];

        return $status[$this->attributes['condition']] ?? 'Unknown Status';
    }

    public function getIsAvailabilityAttribute()
    {
        $status = [
            0 => 'Not-Available',
            1 => 'Available',
            // Add more roles as needed
        ];

        return $status[$this->attributes['availability']] ?? 'Unknown Status';
    }

    public function getIsActiveItemAttribute()
    {
        $status = [
            1 => 'Active',
            2 => 'Deactivated',
            3 => 'Deleted',
            // Add more roles as needed
        ];

        return $status[$this->attributes['isActive']] ?? 'Unknown Status';
    }
}
