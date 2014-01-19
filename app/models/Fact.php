<?php
    
class Fact extends Eloquent{
    protected $table = 'Facts';
    public $timestamps = false;
    // Allow only these to be mass filled
    protected $fillable = array('catID', 'fact', 'userID', 'time');

    // Maintain One to Many relationship with category
    public function category(){
        return $this->belongsTo('Category', 'catID', 'id');
    }

    public function ratings(){
        return $this->hasMany('Rating', 'factID', 'id');
    }
}

?>
