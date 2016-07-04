<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Sites extends Model {

    use SoftDeletes;

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $dates = ['deleted_at'];

    protected $table    = 'sites';
    
    protected $fillable = [
          'site_name',
          'site_links'
    ];
    

    public static function boot()
    {
        parent::boot();

        Sites::observe(new UserActionsObserver);
    }
    
    
    
    
}