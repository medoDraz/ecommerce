<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    protected $table = 'sub_categories';

    protected $fillable = [
        'translation_lang','parent_id', 'translation_of','name','slug','photo','active',
    ];

    public function scopeActive($query){
        return $query -> where('active',1);
    }

    public function scopeDefaultCategory($query){
        return $query -> where('translation_of',0);
    }

    public function scopeSelection($query){

        return $query -> select('id','parent_id','translation_lang','name','slug','photo','active');
    }

    public function  getActive(){
        return $this -> active == 1 ? 'مفعل'  : 'غير مفعل';

    }

    public function getImagePathAttribute(){
        return asset('uploads/subcategory/'.$this->photo);
    }

    public function mainCategory(){
        return $this->belongsTo(MainCategory::class,'category_id','id');
    }
}
