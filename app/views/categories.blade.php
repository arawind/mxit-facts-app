<!DOCTYPE html>
<html>
<head>
    <title>Facts | Categories</title>
</head>
<body>
    <h1>Categories</h1>
    @foreach($categories as $category)
        @if($category->deleted == false)
            <p><a href="{{$category->id}}/facts">{{$category->catName}}</a></p>
        @endif
    @endforeach

</body>
</html>
