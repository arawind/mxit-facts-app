<?php

class Rating extends Eloquent{
    protected $table = 'Ratings';
    public $timestamps = false;
    
    public function fact(){
        return $this->belongsTo('Fact', 'factID', 'id');
    }
}

?>
