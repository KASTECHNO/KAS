<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Service extends Model {
    protected $fillable = ['title','slug','short_desc','description','icon_class','display_order','is_active'];
}
