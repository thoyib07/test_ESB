<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;

    protected $table= 'products';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = [];

    public function ItemType()
    {
        return $this->belongsTo(ItemType::class,'item_type_id','id');
    }

    public function scopeAktif($query)
    {;
        return $query->whereNull('deleted_at');
    }

    public function scopeTidakAktif($query)
    {
        return $query->whereNotNull('deleted_at');
    }
}
