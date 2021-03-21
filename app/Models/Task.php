<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Task extends Model
{
    //     /**
    //  * The attributes that are mass assignable.
    //  *
    //  * @var array
    //  */
    // protected $fillable = [
    //     'title', 'completion', 'status'
    // ];

        /**
     * The associated category
     */
    public function category()
    {
        // return $this->belongsTo('App\Models\Category');
        // Category::class => 'App\Models\Category'
        // (le FQCN de la classe)
        return $this->belongsTo(Category::class);
    }
}



