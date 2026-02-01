<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model {
    protected $table = 'company';
    protected $fillable = ['name','slogan','description','address','email','phone','website_url','logo_url'];
}


