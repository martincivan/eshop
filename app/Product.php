<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

class Product extends Model
{
    public function material()
    {
        return $this->belongsTo('App\Material');
    }

    public function orders()
    {
        return $this->belongsToMany('App\Order')->withPivot('number');
    }

    public function delete()
    {
        $result = parent::delete();

        if ($result && File::exists(public_path("/img/products/$this->id.jpg"))) {
            File::delete(public_path("/img/products/$this->id.jpg"));
        }

        return $result;
    }
}
