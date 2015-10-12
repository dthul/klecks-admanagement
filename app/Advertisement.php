<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'advertisements';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comments', 'paid'];

    /**
     * Get the customer that owns the advertisement.
     */
    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }

    /**
     * Get the adformat that owns the advertisement.
     */
    public function adformat()
    {
        return $this->belongsTo('App\Adformat');
    }
}
