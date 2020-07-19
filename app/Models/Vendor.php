<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Vendor extends Model
{
    use Notifiable;

    protected $table = 'vendors';

    protected $fillable = [
        'name', 'logo','mobile','address','email','password','category_id','active','latitude', 'longitude',
    ];

    protected $appends=['image_path'];

    public function getNameAttribute($value){
        return ucfirst($value);
    }

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

        return $query -> select('id','name','category_id','logo','mobile','active','latitude', 'longitude');
    }

    public function main_category(){
        return $this->belongsTo(MainCategory::class,'category_id');
    }
}
