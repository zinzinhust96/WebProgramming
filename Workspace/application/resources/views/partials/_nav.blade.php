<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand no-padding" href="/">
                <img class="main-logo" src="{{ asset('icon/logo.png') }}">
                <span class="sr-only">Library Management System</span>
            </a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/')||Request::is('home') ? "active" : "" }}"><a href="{{ route('home') }}">Home</a></li>
                @role('admin')
                    <li class="{{ Request::is('user') ? "active" : "" }}"><a href="#">Users</a></li>
                @endrole
                @role(['admin', 'librarian'])
                    <li class="{{ Request::is('borrow-card') ? "active" : "" }}"><a href="{{ route('borrow-card.index') }}">Borrow Card</a></li>
                @endrole
                @role(['admin', 'librarian'])
                    <li class="{{ Request::is('book') ? "active" : "" }}"><a href="{{ route('book.index') }}">Books</a></li>
                @endrole
                @role(['admin', 'librarian'])
                    <li class="{{ Request::is('borrow-book/create') ? "active" : "" }}">
                        <a href="{{ route('borrow-book.create') }}">Lent Books</a></li>
                @endrole
                @role(['admin', 'librarian'])
                    <li class="{{ Request::is('return-book/create') ? "active" : "" }}">
                        <a href="{{ route('return-book.create') }}">Return Books</a></li>
                @endrole
                @role('borrower')
                    <li class="{{ Request::is('activate-card') ? "active" : "" }}">
                        <a href="{{ route('activate-card.showForm') }}">Activate card</a>
                    </li>
                @endrole
                <li class="{{ Request::is('about') ? "active" : "" }}"><a href="{{ route('about') }}">About</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ route('login') }}">Login</a></li>
                    <li><a href="{{ route('register') }}">Register</a></li>
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                            {{ Auth::user()->name }} <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li>
                                <a href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
