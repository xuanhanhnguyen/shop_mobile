<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class hinh_anh extends Model
{
    //
    protected $table = "hinh_anh";
    protected $fillable = ['ten', 'sp_id'];
    public $timestamps = false;
}
