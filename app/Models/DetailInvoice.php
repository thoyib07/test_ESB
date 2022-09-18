<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailInvoice extends Model
{
    use HasFactory,SoftDeletes;

    protected $table= 'detail_invoices';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = [];

    public function Invoice()
    {
        return $this->belongsTo(Invoice::class,'invoice_id','id');
    }

    public function Product()
    {
        return $this->belongsTo(Product::class,'product_id','id');
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
