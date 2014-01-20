<?php

class UserController extends BaseController{
    public function signin(){
        if(Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')))){
            if(Auth::user()->disabled == 0){
                Auth::logout();
                return 'Not yet activated';
            }
            return Redirect::intended('categories');
        }
        else
            return 'fail';
    }

    public function register(){
        //validation needs to be done
        $user = new UserNew;
        $user->username = Input::get('username');
        $user->password = Hash::make(Input::get('password'));
        $user->save();
        return 'Needs to be activated.';
    }
}

?>
