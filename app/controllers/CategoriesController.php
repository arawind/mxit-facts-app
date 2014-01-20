<?php

class CategoriesController extends BaseController{

    public function __construct(){
        $this->beforeFilter('auth', array('except' => array('gCategories')));
    }

    public function getIndex(){
        $this->getAdmin();
    }

    // Handle the GET requests
    public function getAdmin(){
        if(Input::get('edit') == ''){
            $limitItems = Input::get('limitItems') == '' ? 5 : Input::get('limitItems');
            if(Input::get('show') == 1)
                $categories = Category::paginate($limitItems);
            else
                $categories = Category::where('deleted', '=', '0')->paginate($limitItems);
        }
        else
            $categories = Category::find(Input::get('edit'));

        return View::make('create-categories')->with('categories', $categories);//->with('edited', Input::get('edit'));
    }

    // Handle the POST requests
    public function postAdmin(){

        // Create a category
        $category = array(
            'catName' => Input::get('frmCatName')
        );

        // 'Delete' a category
        if(Input::get('submit')=="Delete"){
            $category = Category::find(Input::get('frmID'));
            $category->deleted = true;
            $category->save();
        }

        // 'Show' a category
        elseif(Input::get('submit')=="Show"){
            $category = Category::find(Input::get('frmID'));
            $category->deleted = false;
            $category->save();
        }

        elseif(Input::get('submit')=="Change Name"){
            $category = Category::find(Input::get('frmID'));
            $category->catName = Input::get('frmCatName');
            $category->save();
            return Redirect::route('catAdmin')->with('edit', Input::get('edit'))->with('show', Input::get('show'));
        }

        // Create a category
        else{
            Category::create($category);
        }

        return Redirect::route('catAdmin');
    }

    // Show all the categories
    public function gCategories(){
        return View::make('categories')->with('categories', Category::all());
    }
}

?>
