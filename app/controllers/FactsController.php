<?php

class FactsController extends BaseController{

    public function __construct(){
        $this->beforeFilter('auth', array('except' => array('gFacts', 'pFacts', 'getShare', 'postShare')));
    }

    // private function to create an array to be transferred to the page
    private function results($id, $all, $numberOfItems = 10){
        $category = Category::find($id);
        if(!$all)
            $facts = $category->facts()->where('approved', '=', true)->paginate($numberOfItems);//->get();
        else
            $facts = $category->facts()->paginate($numberOfItems);//->get();

        $ratings = array();
        foreach($facts->getItems() as $fact){
            $ratings['factInteresting'.$fact->id] = $fact->ratings()->getQuery()->where('rating','=','1')->count();
            $ratings['factBoring'.$fact->id] = $fact->ratings()->getQuery()->where('rating','=','-1')->count();
            $ratings['factFake'.$fact->id] = $fact->ratings()->getQuery()->where('rating','=','-2')->count();
        }

        $results = array( 
            'id' => $id,
            'name' => $category->catName,
            'facts' => $facts,
            'ratings' => $ratings
        );

        return $results;
    }

    // Show all facts
    public function gFacts($id){ 
        return View::make('facts', array('results'=>$this->results($id, false, 1)));
    }

    // Handle the GET requests
    public function getIndex($id){
        if(Input::get('limitItems') != null)
            return View::make('create-facts', array('results'=>$this->results($id,true, Input::get('limitItems'))));
        return View::make('create-facts', array('results'=>$this->results($id, true)));
    }

    // Handle the POST requests
    public function postIndex(){

        // Create the array containing the values in the request
        $fact = array(
            'catID' => Input::get('frmCatID'),
            'fact' => Input::get('frmFact'),
            'userID' => Input::get('frmUserID'),
            'time' => date('Y-m-d H:i:s') 
        );

        $submitValue = Input::get('submit');

        // Change the fact
        if($submitValue == "Change"){
            $fact = Fact::find(Input::get('frmID'));
            $fact->fact = Input::get('frmFact');
            $fact->save();
        }

        // Approve the fact
        elseif($submitValue == "Show"){
            $fact = Fact::find(Input::get('frmID'));
            $fact->approved = true; 
            $fact->save();
        }

        // Disapprove the fact
        elseif($submitValue == "Hide"){
            $fact = Fact::find(Input::get('frmID'));
            $fact->approved = false; 
            $fact->save();
        }

        // Create the fact otherwise
        elseif($submitValue == "Submit"){
            Fact::create($fact);
        }
        
        else{
            return 'what?';
        }

        return Redirect::to(Request::fullUrl());
    }

    // Handles ratings
    public function pFacts($id){
        // Ratings 
        $userID = Request::server('HTTP_X_MXIT_USERID_R');

        if(Input::get('submit') == "Rate" && $userID != ""){
            $rating = Input::get('frmRating') == "-1" ? -1 : (Input::get('frmRating') == "1" ? 1 : -2);

            // Find the ratings for the fact and within them search for a record with the userID and current rating
            // if $alreadyRated = 1, the user has already given the same rating once before and hence it wont be accepted
            $fact = Fact::find(Input::get('frmID'));
            $alreadyRated = 0;
            if($fact)
                $alreadyRated = $fact->ratings()->getQuery()->whereRaw('userID = ? and rating = ?', array($userID, $rating))->count();
            
            if($alreadyRated == 0){
                $rater = new Rating;
                $rater->userID = $userID;
                $rater->factID = Input::get('frmID');
                $rater->rating = $rating;
                $rater->save();
            }
        }

        return Redirect::to(Request::fullUrl());
    }

    public function getShare($id){
        return View::make('facts-share', array('id' => $id));
    }

    public function postShare($id){
        $fact = new Fact;
        $fact->fact = Input::get('frmFact');
        $fact->userID = Request::server('HTTP_X_MXIT_USERID_R');
        $fact->catID = Input::get('frmID');
        $fact->time = date('Y-m-d H:i:s'); 
        $fact->save();

        return Redirect::to(Input::get('frmBack'));
    }
}

?>
