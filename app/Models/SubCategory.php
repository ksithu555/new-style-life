<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    function subCategoryTitle() {
        return $this->belongsTo(SubCategoryTitle::class,'sub_category_title_id');
    }
}