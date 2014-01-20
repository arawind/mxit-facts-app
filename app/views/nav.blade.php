@if(!Request::server('HTTP_X_MXIT_USERID_R')) 
<nav class="navbar navbar-default">
    <div class="navbar-inner">
        <div class="container">
            {{HTML::link(URL::route('home'), 'Facts', array('class' => 'navbar-brand'))}}
            <ul class="nav navbar-nav">
                <li class = "{{Route::currentRouteName()=='home' ? 'active' : ''}}"> {{ HTML::link(URL::route('home'), 'Home')}} </li>
                @if(!Auth::check())
                <li class = "{{Route::currentRouteName()=='login' ? 'active' : ''}}"> {{ HTML::link(URL::route('login'), 'Login')}} </li>
                @else
                    @if(!strpos(Request::url(), '/admin'))
                <li> {{HTML::link(Request::url().'/admin', 'Edit')}} </li> 
                    @else
                <li> {{HTML::link(str_replace('/admin', '', Request::url()), 'Leave Edit')}} </li> 
                    @endif
                <li> {{HTML::link(URL::route('logout'), 'Logout')}} </li> 
                @endif
            </ul>
        </div>
    </div>
</nav>
@endif
