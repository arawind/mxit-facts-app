<!DOCTYPE html>
<html>
<head>
    <title>{{$results['name']}}</title>
</head>

<body>
    
<h1>{{$results['name']}} Facts</h1>

@foreach($results['facts'] as $fact)
    @if($fact->approved == true)
    <p>{{$fact->fact}}</p>
    <p>
    <?php $page = isset($_GET['page']) ? $_GET['page'] : 1; ?> 
    {{Form::open(array('url'=>$results['id'].'/facts?page='.$page))}} 
    <input type="hidden" name="frmCatID" value="{{$results['id']}}" />
    <input type="hidden" name="frmID" value="{{$fact->id}}" />
    <input type="radio" name="frmRating" value="1" /> Interesting({{$results['ratings']['factInteresting'.$fact->id]}})
    <input type="radio" name="frmRating" value="-1" /> Boring({{$results['ratings']['factBoring'.$fact->id]}})
    <input type="radio" name="frmRating" value="-2" /> Fake({{$results['ratings']['factFake'.$fact->id]}})
    <input type="submit" name="submit" value="Rate" />
    {{Form::close()}}
    </p>
    @endif
@endforeach
{{$results['facts']->links()}}

</body>

</html>
