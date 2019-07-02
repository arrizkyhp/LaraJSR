   <!-- Left Panel -->

    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">

            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="./"> <img src="{{ asset('front/img/logo.png') }}" width="180px" alt=""> <p> App</p></a>
                <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logoJSR.png') }}" width="150px" alt=""></a>
            </div>

            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li class="active">
                        <a href="{{ asset('admin/dashboard')}}"> <i class="menu-icon fa fa-dashboard"></i>Dashboard </a>
                    </li>

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-shopping-cart""></i>Transaksi</a>
                        <ul class="sub-menu children dropdown-menu">
                            @if (auth()->user()->role == 0 )
                                <li><i class="fa fa-cutlery"></i><a href="{{ asset('admin/pesanan')}}">Pesanan</a></li>
                                <li><i class="fa fa-bars"></i><a href="{{ asset('admin/list_pesanan')}}">List Pesanan</a></li>
                            @elseif (auth()->user()->role == 1)
                                <li><i class="fa fa-glass"></i><a href="{{ asset('admin/penyewaan')}}">Penyewaan</a></li>
                                <li><i class="fa fa-bars"></i><a href="{{ asset('admin/list_penyewaan')}}">List Penyewaan</a></li>
                            @endif


                        </ul>
                    </li>

                                      <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-hdd-o"></i>Manajemen Data</a>
                        <ul class="sub-menu children dropdown-menu">
                            @if (auth()->user()->role == 0 )
                                <li><i class="fa fa-cutlery"></i><a href="{{ asset('admin/menu')}}">Menu</a></li>
                                <li><i class="fa fa-coffee"></i><a href="{{ asset('admin/jenis_pesanan')}}">Jenis Pesanan</a></li>
                                <li><i class="fa fa-cutlery"></i><a href="{{ asset('admin/list_makanan')}}">Makanan/Minuman</a></li>
                                <li><i class="fa fa-user"></i><a href="{{ asset('admin/pelanggan')}}">Pelanggan</a></li>
                            @elseif (auth()->user()->role == 1)
                                <li><i class="fa fa-bars"></i><a href="{{ asset('admin/peralatan')}}">Peralatan</a></li>
                            @endif


                        </ul>
                    </li>


                     @if (auth()->user()->role == 0 )
                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i>Manajemen Users</a>
                        <ul class="sub-menu children dropdown-menu">

                        <li><i class="fa fa-user"></i><a href="{{ asset('admin/users')}}">User</a></li>
                        </ul>
                    </li>


                    @elseif (auth()->user()->role == 1)
                    @endif

                    <li class="menu-item-has-children dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-th"></i>Laporan</a>
                        <ul class="sub-menu children dropdown-menu">
                        @if (auth()->user()->role == 0 )

                            <li><i class="fa fa-user"></i><a href="{{ asset('admin/laporan_pesanan')}}">Pesanan</a></li>
                        @elseif (auth()->user()->role == 1)
                            <li><i class="menu-icon fa fa-book"></i><a href="forms-basic.html">Penyewaan</a></li>
                            <li><i class="menu-icon fa fa-book"></i><a href="{{ asset('admin/peralatan_rusak')}}">Peralatan Rusak</a></li>
                        @endif
                        </ul>
                    </li>

                     @if (auth()->user()->role == 0 )
                    <li class="active">
                        <a href="{{ asset('admin/konten')}}"> <i class="menu-icon fa fa-smile-o"></i>Konten</a>
                    </li>
                     @elseif (auth()->user()->role == 1)
                    @endif


                    <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" > <i class="menu-icon fa fa-sign-out"></i> Logout</a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>

                    </li>



                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside><!-- /#left-panel -->

    <!-- Left Panel -->