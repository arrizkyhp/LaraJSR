
<!DOCTYPE html>
<html lang="en">

<head>

  <link rel="apple-touch-icon-precomposed" sizes="57x57" href="img/icon/apple-touch-icon-57x57.png" />
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="img/icon/apple-touch-icon-114x114.png" />
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="img/icon/apple-touch-icon-72x72.png" />
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="img/icon/apple-touch-icon-144x144.png" />
  <link rel="apple-touch-icon-precomposed" sizes="60x60" href="img/icon/apple-touch-icon-60x60.png" />
  <link rel="apple-touch-icon-precomposed" sizes="120x120" href="img/icon/apple-touch-icon-120x120.png" />
  <link rel="apple-touch-icon-precomposed" sizes="76x76" href="img/icon/apple-touch-icon-76x76.png" />
  <link rel="apple-touch-icon-precomposed" sizes="152x152" href="img/icon/apple-touch-icon-152x152.png" />
  <link rel="icon" type="image/png" href="img/icon/favicon-196x196.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="img/icon/favicon-96x96.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="img/icon/favicon-32x32.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="img/icon/favicon-16x16.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="img/icon/favicon-128.png" sizes="128x128" />
  <meta name="application-name" content="&nbsp;" />
  <meta name="msapplication-TileColor" content="#FFFFFF" />
  <meta name="msapplication-TileImage" content="mstile-144x144.png" />
  <meta name="msapplication-square70x70logo" content="mstile-70x70.png" />
  <meta name="msapplication-square150x150logo" content="mstile-150x150.png" />
  <meta name="msapplication-wide310x150logo" content="mstile-310x150.png" />
  <meta name="msapplication-square310x310logo" content="mstile-310x310.png" />


  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="{{ asset('images/logoJSR.png') }}">

  <title>Jembar Sari Rasa</title>

  <!-- Bootstrap core CSS -->
  <link href="{{ asset('front/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="{{ asset('front/vendor/fontawesome-free-5.8.1-web/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
  <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
  <link href="{{ asset('front/css/font.css') }}" rel="stylesheet">
  <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet'
    type='text/css'>
  <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>


  <!-- Custom styles for this template -->
  <link href="{{ asset('front/css/agency.min.css') }}" rel="stylesheet">

</head>

<body id="page-top">

  @include('layouts.front.module.navbar')

  <!-- Header -->
  <header class="masthead">
    <div class="container">
      <div class="intro-text">
        <div class="intro-lead-in">Selamat Datang di</div>
        <div class="intro-heading text-uppercase">Jembar Sari Rasa</div>
        <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="#services">Selengkapnya</a>
      </div>
    </div>
  </header>




  <!-- Services -->
  <section id="services">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-left">
          <h2 class="section-heading text-uppercase">Layanan</h2>

        </div>
      </div>
      <div class="row text-center">
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fa fa-box fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Nasi Box</h4>
          <p class="text-muted">Kami Menyediakan Pelayanan Nasi Box dan Snack Box untuk berbagai Acara.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fa fa-birthday-cake fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Tumpeng Hias</h4>
          <p class="text-muted">Kami berpengalaman dalam layanan Tumpeng Hias berbagai macam hidangan menjadi lebih menarik dan juga lezt cocok untuk berbagai Acara.</p>
        </div>
        <div class="col-md-4">
          <span class="fa-stack fa-4x">
            <i class="fa fa-circle fa-stack-2x text-primary"></i>
            <i class="fa fa-users fa-stack-1x fa-inverse"></i>
          </span>
          <h4 class="service-heading">Catering Acara</h4>
          <p class="text-muted">Kami Juga melayani Catering untuk berbagai macam acara seperti Pernikahan, Rapat, Syukuran, Seminar, dsb .</p>
        </div>
      </div>
    </div>
  </section>

   <section class="bg-light" id="list">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">List Sajian</h2>
          <h3 class="section-subheading text-muted">Berbagai Macam Makanan, Minuman, Dan Snack yang disajikan di Jembar Sari Rasa</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
      <a class="btn btn-primary btn-xl"  data-toggle="modal"  href="#modalMakanan">List Sajian</a>
      </div>
      </div>




    </div>
  </section>




  <!-- Portfolio Grid -->
  <section  id="portfolio">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Menu</h2>
          <h3 class="section-subheading text-muted">Beberapa Menu yang tersedia di jembar Sari Rasa</h3>

        </div>
      </div>

      <div class="row">
         @foreach ($konten as $value)
        <div class="col-md-4 col-sm-6 portfolio-item">
          <a class="portfolio-link  js-scroll-trigger" href="#contact">
            <div class="portfolio-hover">
              <div class="portfolio-hover-content">
                Pesan
              </div>
            </div>
            <img class="img-fluid" src="{{ asset('uploads/'.@$value->foto) }}"  alt="">
          </a>
          <div class="portfolio-caption">
            <h4>{{ $value->nama_konten }}</h4>
            <p class="text-muted">{{ $value->jenis->nama_jenis_pesanan }}</p>
          </div>
        </div>
         @endforeach

    </div>
  </section>

  <!-- Portfolio Grid -->
  <section class="bg-light" id="sewa">
    <div class="container">

      <div class="row">
        <div class="col-lg-12 text-center">
          <h2 class="section-heading text-uppercase">Sewa Peralatan</h2>
          <h3 class="section-subheading text-muted">Jembar Sari Rasa juga menyediakan Penyewaan Peralatan Catering</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12 text-center">
      <a class="btn btn-primary btn-xl"  data-toggle="modal"  href="#modalSewa">List Peralatan</a>
      </div>
      </div>




    </div>
  </section>








@include('layouts.front.module.footer')

  <!-- Portfolio Modals -->

    <!-- Modal 1 -->
  <div class="portfolio-modal modal fade" id="modalSewa" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">List Harga Sewa Peralatan Catering</h2>
                <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama Peralatan</th>
                        <th>Satuan</th>
                        <th>Harga Sewa</th>
                        <th>Harga Ganti</th>
                      </tr>
                    </thead>
                    <tbody>
                        @php $no = 1; @endphp
                      @foreach ($peralatan as $alat)
                        <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $alat->nama_peralatan }}</td>
                        <td>{{ $alat->satuan->nama_satuan }}</td>
                        <td>Rp.{{ number_format($alat->harga_sewa,0,',', '.')  }}</td>
                        <td>Rp.{{ number_format($alat->harga_ganti,0,',', '.')   }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                {{-- <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est
                  blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia
                  expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                <ul class="list-inline">
                  <li>Date: January 2017</li>
                  <li>Client: Threads</li>
                  <li>Category: Illustration</li>
                </ul> --}}
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fa fa-times"></i>
                  Close Project</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

   <!-- Modal 1 -->
  <div class="portfolio-modal modal fade" id="modalMakanan" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="close-modal" data-dismiss="modal">
          <div class="lr">
            <div class="rl"></div>
          </div>
        </div>
        <div class="container">
          <div class="row">
            <div class="col-lg-8 mx-auto">
              <div class="modal-body">
                <!-- Project Details Go Here -->
                <h2 class="text-uppercase">List Makanan/Minuman/Snack</h2>
                <p class="item-intro text-muted">Beberapa List Makanan,Minuman,Dan Snack yang tersedia di Jembar Sari Rasa.</p>
                  <h3>Makanan/Minuman</h3>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Harga</th>

                      </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp
                      @foreach ($makanan as $makan)
                        <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $makan->nama_makanan }}</td>
                        <td>{{ $makan->jenis_makanan->nama_jenis_makanan }}</td>
                        <td>Rp.{{ number_format($makan->harga,0,',', '.') }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>

                  <h3>Snack</h3>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Jenis</th>
                        <th>Harga</th>

                      </tr>
                    </thead>

                    <tbody>
                        @php $no = 1; @endphp
                      @foreach ($snack as $makan)
                        <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $makan->nama_makanan }}</td>
                        <td>{{ $makan->jenis_makanan->nama_jenis_makanan }}</td>
                        <td>Rp.{{ number_format($makan->harga,0,',', '.')  }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
                {{-- <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est
                  blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia
                  expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                <ul class="list-inline">
                  <li>Date: January 2017</li>
                  <li>Client: Threads</li>
                  <li>Category: Illustration</li>
                </ul> --}}
                <button class="btn btn-primary" data-dismiss="modal" type="button">
                  <i class="fa fa-times"></i>
                  Close Project</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>




  <!-- Bootstrap core JavaScript -->
  <script src="{{ asset('front/vendor/jquery/jquery.min.js') }}"></script>
  <script src="{{ asset('front/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

  <!-- Plugin JavaScript -->
  <script src="{{ asset('front/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

  <!-- Contact form JavaScript -->
  <script src="{{ asset('front/js/jqBootstrapValidation.js') }}"></script>
  <script src="{{ asset('front/js/contact_me.js') }}"></script>

  <!-- Custom scripts for this template -->
  <script src="{{ asset('front/js/agency.min.js') }}"></script>

</body>

</html>