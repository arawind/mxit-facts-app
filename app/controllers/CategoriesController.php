<?php

class CategoriesController extends BaseController{

    // Handle the GET requests
    public function getIndex(){
        return View::make('create-categories')->with('categories', Category::all());
    }

    // Handle the POST requests
    public function postIndex(){

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

        // 'Change' the name of the category
        elseif(Input::get('submit')=="Change"){
            $category = Category::find(Input::get('frmID'));
            $category->catName = Input::get('frmCatName');
            $category->save();
        }

        // Create a category
        else{
            Category::create($category);
        }

        return Redirect::to('/create-categories');
    }

    // Show all the categories
    public function getCategories(){
        return View::make('categories')->with('categories', Category::all());
    }
}

?>
