<?php

namespace App;

use Illuminate\Support\Facades\DB;
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
    protected $fillable = ['comment', 'paid', 'adformat_id', 'page'];

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

    public function getIssue()
    {
        return DB::table('advertisements')
            ->where('advertisements.id', '=', $this->id)
            ->join('adformats', 'advertisements.adformat_id', '=', 'adformats.id')
            ->join('issues', 'adformats.issue_id', '=', 'issues.id')
            ->select('issues.*')
            ->first();
    }
}
