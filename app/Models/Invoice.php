<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    protected $table= 'invoices';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = [];
    // protected $dates = ['deleted_at'];

    public function DetailInvoice()
    {
        return $this->hasMany(DetailInvoice::class,'invoice_id','id');
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
