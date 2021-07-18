<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sysmenu extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'sysmenus';
    public function categories()
    {
        return $this->hasMany(sysmenu::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(sysmenu::class)->with('categories');
    }
}
