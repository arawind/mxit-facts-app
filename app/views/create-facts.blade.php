<!DOCTYPE html>
<html>
<head>
    <title>{{$results['name']}}</title>
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('main.css') }}
</head>

<body>
@include('nav')
<div class="container">
<h1>{{$results['name']}} Facts</h1>
<?php
    $formURL = array('url' => Request::fullUrl());
?>
{{Form::open(array('url' => Request::fullUrl(), 'method' => 'GET'))}}
<?php $pageName = $results['facts']->getEnvironment()->getPageName(); ?>
<input type="hidden" name="{{$pageName}}" value="{{ Input::get($pageName) }}" />
Limit items on page: 
<input type="text" name="limitItems" value="{{ Input::get('limitItems') != ""? Input::get('limitItems') : 10 }}" size="1" /> <input type="submit" />
{{Form::close()}}
<table border="1">
    <thead>
    <tr>
        <th>
            Fact
        </th>
        <th>
            Status
        </th>
        <th>
            Change
        </th>
        <th>
            User
        </th>
        <th>
            Interesting 
        </th>
        <th>
            Boring  
        </th>
        <th>
            Fake 
        </th>
        <th>
            Total
        </th>
    </tr>
    </thead>
@foreach($results['facts'] as $fact)
    <tr style="vertical-align:center">
        <td>
            {{$fact->fact}}
        </td>
        <td align="center">
            @if($fact->approved==false) Show @else Hide @endif
        </td>
        <td align="center">
            {{Form::open($formURL)}}
            <input type="hidden" name="frmID" value="{{$fact->id}}" />
            <input type="hidden" name="frmCatID" value="{{$results['id']}}" />
            <input type="submit" name="submit" @if($fact->approved==false) value="Show" @else value="Hide" @endif />
            {{Form::close()}}
        </td>
        <td align="center">
            {{$fact->userID}}
        </td>
        <td align="center">
            {{$results['ratings']['factInteresting'.$fact->id]}}
        </td>
        <td align="center">
            {{$results['ratings']['factBoring'.$fact->id]}}
        </td>
        <td align="center">
            {{$results['ratings']['factFake'.$fact->id]}}
        </td>
        <td align="center">
            {{
                $results['ratings']['factInteresting'.$fact->id] +
                $results['ratings']['factBoring'.$fact->id] +
                $results['ratings']['factFake'.$fact->id]
            }}
        </td>
    </tr>
@endforeach
</table>
{{$results['facts']->appends(array('limitItems' => Input::get('limitItems') ))->links()}}
{{Form::open($formURL)}}
    <input type="hidden" value="{{$results['id']}}" name="frmCatID" />
    <p>Fact</p>
    <textarea name="frmFact"></textarea>
    <p>UserID</p>
    <input type="text" name="frmUserID" />
    <input type="submit" name="submit" value="Submit" />
{{Form::close()}}
</div>
</body>

</html>
