<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use HasFactory,SoftDeletes;

    protected $table= 'clients';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
    protected $fillable = [];

    public function City()
    {
        return $this->belongsTo(City::class,'city_id','id');
    
    }
    public function Counrty()
    {
        return $this->belongsTo(Country::class,'country_id','id');
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
