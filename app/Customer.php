<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'address', 'telephone', 'email', 'comment'];

    /**
     * Get the advertisements for the customer.
     */
    public function advertisements()
    {
        return $this->hasMany('App\Advertisement');
    }
}
