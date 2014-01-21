<!DOCTYPE html>
<html>
<head>
    <title>Share a fact</title>
</head>
<body>
@if(Request::server('HTTP_X_MXIT_USERID_R'))
Share a fact:
<br>
<br>
Select 'options'-> 'write', write your fact and then click 'send'
<br>
{{Form::open(array('url' => Request::url()))}}
    {{Form::hidden('frmBack', URL::previous())}}
    {{Form::hidden('frmID', $id)}}
    {{Form::text('frmFact')}}
    {{Form::submit('Submit')}}
{{Form::close()}}
@endif
<br>
{{HTML::link(URL::previous(), 'Back')}}
</body>

</html>
