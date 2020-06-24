<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = [
        'name', 'logo','mobile','address','email','category_id','active',
    ];


    public function scopeActive($query){
        return $query -> where('active',1);
    }

    public function  getActive(){
        return $this -> active == 1 ? 'مفعل'  : 'غير مفعل';

    }

    public function getImagePathAttribute(){
        return asset('public/uploads/vendors/'.$this->logo);
    }

    public function scopeSelection($query){

        return $query -> select('id','name','category_id','logo','mobile','active');
    }

    public function main_category(){
        return $this->belongsTo(MainCategory::class,'category_id');
    }
}
