<?php

class Category extends Eloquent{
    protected $table = 'Categories';
    public $timestamps = false;
    // Allow only catName-s to be mass filled
    protected $fillable = array('catName');

    // Share a One to Many relationship with facts
    public function facts(){
        return $this->hasMany('Fact', 'catID', 'id');
    }
}  

?>
