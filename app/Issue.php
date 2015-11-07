<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Issue extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'issues';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'due'];

    /**
     * Get the adformats for the issue.
     */
    public function adformats()
    {
        return $this->hasMany('App\Adformat');
    }

    /**
     * Get the advertisements for the issue.
     */
    public function advertisements()
    {
        return $this->hasManyThrough('App\Advertisement', 'App\Adformat');
    }

    public function getDates()
    {
        return ['created_at', 'updated_at', 'due'];
    }
}
