@if(!isset($_REQUEST['X-Mxit-USERID-R']) && !Auth::check())
    <p>{{HTML::link(Request::url().'/admin','Login')}}</p>
@elseif(Auth::check() && !strpos(Request::url(), 'admin'))
    <p>{{HTML::link(Request::url().'/admin', 'Admin')}}</p>
    <p>{{HTML::link(URL::to('logout'), 'Logout')}}</p>
@elseif(Auth::check() && strpos(Request::url(), '/admin'))
    <p>{{HTML::link(str_replace('/admin', '', Request::url()), 'Back to normal')}}
    <p>{{HTML::link(URL::to('logout'), 'Logout')}}</p>
@endif
