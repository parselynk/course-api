<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    protected $dateFormat = 'U';

     /* Course has many Sessions.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function session()
    {
        return $this->belongsTo(Session::class);
    }
}
