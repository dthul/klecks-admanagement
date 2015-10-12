<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adformat extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'adformats';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'price'];

    /**
     * Get the issue that owns the adformat.
     */
    public function issue()
    {
        return $this->belongsTo('App\Issue');
    }

    /**
     * Get the advertisements for the adformat.
     */
    public function advertisements()
    {
        return $this->hasMany('App\Advertisement');
    }
}
