<!DOCTYPE html>
<html>
<head>
    <title>Login|Register</title>
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('main.css') }}
</head>

<body>
@include('nav')
<div class="container">
    <div class="row">
    <div class="col-md-4 col-md-offset-1">
    <h3>Login</h3>
    {{Form::open(array('url' => URL::to('signin')))}}
        <div class="form-group">
            <label for="usernameLogin"> Username: </label>
            {{Form::text('username', 'aravind', array('id'=>'usernameLogin',
                'class' => 'form-control', 'autofocus' => 'true'))}}
        </div>
        <div class="form-group">
            <label>Password: </label>
            {{Form::password('password', array('id'=>'passwordLogin', 
                'class' => 'form-control'))}}
        </div>
            {{Form::submit('Submit', array('class' => 'btn btn-primary'))}}
    {{Form::close()}}
    </div>

    <div class="col-md-4 col-md-offset-1">
    <h3>Register</h3>
    
    {{Form::open(array('url' => URL::to('register')))}}
        
        <div class="form-group">
        <label for="usernameRegister">Username: </label>
            {{Form::text('username', '', array('class' => 'form-control', 'id' => 'usernameRegister', 'placeholder' => 'Enter username'))}}
        </div>
        <div class="form-group">
        <label for="passwordRegister">Password: </label>
            {{Form::password('password', array('id' => 'passwordRegister', 'class' => 'form-control'))}}
        </div>
        {{Form::submit('Submit', array('class' => 'btn btn-default'))}}
    {{Form::close()}}
    </div>
    </div>
</div>

</body>

</html>
