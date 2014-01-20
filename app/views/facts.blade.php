<!DOCTYPE html>
<html>
<head>
    <title>{{$results['name']}}</title>
@if(!Request::server('HTTP_X_MXIT_USERID_R')) 
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('main.css') }}
    @endif
</head>

<body>
    @if(!isset($_REQUEST['X-Mxit-USERID-R']))
    @include('nav')
    @endif
<div class="container">
    <table align="center" width="100%" title="mxit:table:full" >
    <colgroup span="1" width="100%"></colgroup>
    <tr>
        <td style="text-align:center; width:100%;">{{$results['name']}} Facts</td>
    </tr>
    </table>

@foreach($results['facts'] as $fact)
    @if($fact->approved == true)
    <p>{{$fact->fact}}</p>
    <p>
    {{Form::open(array('url'=> Request::fullUrl()))}} 
    <input type="hidden" name="frmCatID" value="{{$results['id']}}" />
    <input type="hidden" name="frmID" value="{{$fact->id}}" />
    <br>
    <label><input type="radio" name="frmRating" value="1" /> Interesting({{$results['ratings']['factInteresting'.$fact->id]}}) </label>
    <br>
    <label><input type="radio" name="frmRating" value="-1" /> Boring({{$results['ratings']['factBoring'.$fact->id]}}) </label>
    <br>
    <label><input type="radio" name="frmRating" value="-2" /> Fake({{$results['ratings']['factFake'.$fact->id]}})</label>
    <input type="submit" name="submit" value="Rate" class="btn btn-default" />
    {{Form::close()}}
    </p>
    @endif
@endforeach
{{$results['facts']->links()}}
<br>
{{HTML::link(url('/'), 'Home')}}
<br>
<a href="mxit://[mxit_recommend]/Recommend?service_name=didyouknowfacts" type="mxit/service-navigation">Share With Friends</a>
</div>
</body>

</html>
