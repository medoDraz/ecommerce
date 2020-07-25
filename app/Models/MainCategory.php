<?php

namespace App\Models;

use App\Observers\MainCategoryObserver;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
{
    protected $table = 'main_categories';

    protected $fillable = [
        'translation_lang', 'translation_of','name','slug','photo','active',
    ];

    protected $appends=['image_path'];

    public function getNameAttribute($value){
        return ucfirst($value);
    }

    protected static function boot()
    {
        parent::boot();
        MainCategory::observe(MainCategoryObserver::class);
    }

    public function scopeActive($query){
        return $query -> where('activ',1);
    }

    public function scopeDefaultCategory($query){
        return $query -> where('translation_of',0);
    }

    public function scopeSelection($query){

        return $query -> select('id','translation_lang','name','slug','photo','active');
    }

    public function  getActive(){
       return $this -> active == 1 ? 'مفعل'  : 'غير مفعل';

    }

    public function getImagePathAttribute(){
        return asset('uploads/maincategory/'.$this->photo);
    }

    ///get all category translation
    public function categories(){
        return $this -> hasMany(self::class,'translation_of');
    }
    public function vendors(){
        return $this -> hasMany(Vendor::class,'category_id','id');
    }

    public function subCategories(){
        return $this->hasMany(SubCategory::class,'category_id','id');
    }



}
