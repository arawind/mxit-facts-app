<!DOCTYPE html>
<html>
<head>
    <title>{{$results['name']}}</title>
</head>

<body>
    
<h1>{{$results['name']}} Facts</h1>
{{Form::open(array('url' => Request::fullUrl(), 'method' => 'GET'))}}
<?php $pageName = $results['facts']->getEnvironment()->getPageName(); ?>
<input type="hidden" name="{{$pageName}}" value="{{ Input::get($pageName) }}" />
<input type="text" name="limitItems" value="{{ Input::get('limitItems') != ""? Input::get('limitItems') : 10 }}" size="1" /> <input type="submit" />
{{Form::close()}}
<table>
@foreach($results['facts'] as $fact)
    <tr style="vertical-align:center">
        <td>
            <form action="create-facts" method="POST"> 
            <input type="hidden" name="frmID" value="{{$fact->id}}" />
            <input type="hidden" name="frmCatID" value="{{$results['id']}}" />
            <textarea name="frmFact" >{{$fact->fact}}</textarea>
            <br>
            <input type="submit" name="submit" value="Change" />
            </form>
        </td>
        <td>
            <form action="create-facts" method="POST"> 
            <input type="hidden" name="frmID" value="{{$fact->id}}" />
            <input type="hidden" name="frmCatID" value="{{$results['id']}}" />
            <input type="submit" name="submit" @if($fact->approved==false) value="Approve" @else value="Disapprove" @endif />
            </form>
        </td>
        <td>
            {{$fact->userID}}
        </td>
    </tr>
@endforeach
</table>
{{$results['facts']->appends(array('limitItems' => Input::get('limitItems') ))->links()}}
<form action="create-facts" method="POST">
    <input type="hidden" value="{{$results['id']}}" name="frmCatID" />
    <p>Fact</p>
    <textarea name="frmFact"></textarea>
    <p>UserID</p>
    <input type="text" name="frmUserID" />
    <input type="submit" name="submit" value="Submit" />
</form>

</body>

</html>
