<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cthd extends Model
{
    //
    protected $table = "chi_tiet_hoa_don";
    protected $fillable = ['hoa_don_id', 'san_pham_id', 'sl_mua', 'don_gia'];
    public $timestamps = false;

    public function san_pham()
    {
        return $this->belongsTo('App\san_pham', 'san_pham_id', 'id');
    }

}
