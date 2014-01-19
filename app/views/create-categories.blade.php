<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
    <style>
        .hide{
            color:red;
        }
    </style>
</head>
<body>

    <table>
    @foreach($categories as $category)
        <tr @if($category->deleted == true) class="hide" @endif >

            <td><form action="./create-categories" method="POST"> <input type="hidden" value="{{$category->id}}" /> <input type="text" value="{{$category->catName}}" name="frmCatName" /> <input type="submit" value="Change" name="submit" />  </td>
            <td> <form action="./create-categories" method="POST"> <input type="hidden" value="{{$category->id}}" name="frmID" /> <input type="submit" @if($category->deleted == false) value="Delete" @else value="Show" @endif  name="submit" /> </form>
            </td>
        </tr>
    @endforeach
    </table>
    <p>
    Create new category
    </p>
    <form action="./create-categories" method="POST" >
        <input type="text" name="frmCatName" />
        <input type="submit" name="submit" />
    </form>
</body>
</html>
