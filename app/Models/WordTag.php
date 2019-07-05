<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WordTag extends Model
{
    protected $table = 'word_tag';

    protected $fillable = [
        'word_id',
        'name'
    ];

    public $timestamps = false;
    
    protected $primaryKey = 'id';

    public function wordannotation()
    {
    	return $this->belongsTo('App\Models\WordAnnotation');
    }
}