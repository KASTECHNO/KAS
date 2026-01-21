<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model {
    protected $fillable = ['client_name','client_role','company','message','avatar_url','display_order','is_active'];
}

