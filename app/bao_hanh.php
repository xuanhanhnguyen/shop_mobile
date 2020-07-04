<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bao_hanh extends Model
{
    //
    protected $table = "bao_hanh";
    protected $fillable = ['hoa_don_id', 'san_pham_id', 'thoi_gian_bao_hanh', 'ly_do_bao_hanh'];
    public $timestamps = false;

    public function san_pham()
    {
        return $this->belongsTo('App\san_pham', 'san_pham_id', 'id');
    }

}
