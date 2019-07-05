<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordAnnotation extends Model
{
    protected $table = 'word_annotation';

    protected $fillable = [
        'word',
        'description'
    ];

    public $timestamps = false;
    
    protected $primaryKey = 'id';
    //protected $foreignkey = 'word_id';

    public function wordtag()
    {
        return $this->hasMany('App\Models\WordTag', 'word_id');
    }
}