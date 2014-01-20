<!DOCTYPE html>
<html>
<head>
    <title>Facts | Categories</title>
@if(!Request::server('HTTP_X_MXIT_USERID_R')) 
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('main.css') }}
    @endif
</head>
<body>
@include('nav')
    <table align="center" width="100%" title="mxit:table:full" >
    <colgroup span="1" width="100%"></colgroup>
    <tr>
        <td style="text-align:center; width:100%;">Categories</td>
    </tr>
    </table>
    @foreach($categories as $category)
        @if($category->deleted == false)
            <p><a href="{{url('/'.$category->id.'/facts')}}">{{$category->catName}}</a></p>
        @endif
    @endforeach
<br>
<a href="mxit://[mxit_recommend]/Recommend?service_name=didyouknowfacts" type="mxit/service-navigation">Share With Friends</a>
</body>
</html>
