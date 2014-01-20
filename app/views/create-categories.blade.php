<!DOCTYPE html>
<html>
<head>
    <title>Categories</title>
@if(!Request::server('HTTP_X_MXIT_USERID_R')) 
    {{ HTML::style('packages/bootstrap/css/bootstrap.min.css') }}
    {{ HTML::style('main.css') }}
    @endif
    <style>
        .hide{
            color:red;
        }
    </style>
</head>
<body>
@include('nav')
<div class="container">
<div class="row">
<div class="col-md-12">
   <h2>Categories Edit</h2>
   @if(Input::get('edit')==null) 
<div class="clearfix">
&nbsp;
</div>

    <table class="table table-condensed table-striped table-hover">
    <thead>
    <tr>
        <th>
            Category Name
        </th>
        <th>
            Change Name 
        </th>
        <th>
            Delete/Show
        </th>
    </tr>
    </thead>
    @foreach($categories as $category)
        <tr>
        {{Form::open( array('url' => Request::fullUrl(), 'method' => 'GET'))}}
            <td>
               <input type="hidden" name="edit" value="{{$category->id}}" /> {{$category->catName}}  
            </td>
            <td>
                <input type="submit" value="Change" class="btn btn-link" />
            </td>
        {{Form::close()}}
            <td> 
        {{Form::open( array('url' => Url::route('catAdmin')) )}}
            <input type="hidden" value="{{$category->id}}" name="frmID" /> <input type="submit" @if($category->deleted == false) value="Delete" class="btn btn-danger" @else value="Show" class="btn btn-warning" @endif  name="submit"  /> 
        {{Form::close()}}
            </td>
        </tr>
    @endforeach
    </table>
    
{{$categories->appends(array('show'=> Input::get('show')))->links()}}

<h3>Settings</h3>
     <div class="col-md-5">
{{Form::open(array('url' => Url::route('catAdmin'), 'class'=>'form-inline'))}}
        <div class="form-group">
        <label for="createCategory">
        Create new category:
        </label>
        {{Form::text('frmCatName', '', array('placeholder'=> 'Enter Category Name', 'id'=>'createCategory', 'class'=>'form-control'))}}
        </div>
        {{Form::submit('Submit', array('name'=>'submit', 'class'=>'btn btn-default'))}}
    {{Form::close()}}
    </div>
    <div class="col-md-4">
    {{Form::open(array('url' => Request::fullUrl(), 'method' => 'GET'))}}
        <label>Show/Hide deleted categories: </label>
        @if(Input::get('show') == 1)
        {{Form::hidden('show', '0')}}
        {{Form::submit('Hide', array('class' => 'btn btn-default'))}}
        @else
        {{Form::hidden('show', '1')}}
        {{Form::submit('Show', array('class' => 'btn btn-default'))}}
        @endif
    {{Form::close()}}
    </div> 
    <div class="col-md-3">
    {{Form::open(array('url' => Request::fullUrl(), 'method' => 'GET', 'class'=>'form-inline'))}}
        <label>Limit page items: </label>
        {{Form::text('limitItems', Input::get('limitItems') == '' ? 5 : Input::get('limitItems'), array('class' => 'form-control', 'size' => '1'))}}
        {{Form::submit('Set', array('class' => 'btn btn-default'))}}
    {{Form::close()}}
    </div>
<div class="clearfix">
&nbsp;
</div>
   

    @else
    <?php $category = $categories;?>
    {{Form::open(array('url' => Request::fullUrl()))}}
        <label for="catName">Category Name: </label>
        <div class="form-group">
        {{Form::hidden('frmID', $category->id)}}
        {{Form::text('frmCatName', $category->catName, array('class'=>'form-control', 'id'=>'catName'))}}
        </div>
        {{Form::submit('Change Name', array('class' => 'btn btn-primary', 'name'=>'submit'))}}
    {{Form::close()}}
  @endif
</div>
</div>
</div>
</body>
</html>
