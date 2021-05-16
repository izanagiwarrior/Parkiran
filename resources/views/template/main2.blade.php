@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
  <title>JuPark</title>
  <link rel="icon" href="foto/logo.png" type="image/icon type">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
  <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
  <link rel="stylesheet" href="assets/css/smoothproducts.css">
  @if ($result != null)
  <style>
    td,
    th {
      background-color: #708090;
      color: white;
    }
  </style>
  @else
  <style>

  </style>
  @endif
</head>

@php
$csrf = csrf_token();
$resulmain = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp

<body style="background-image: url('foto/bg.jpg'); height: 100%;  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">
  @if ($resulmain != null)
  <nav class="navbar  navbar-expand-lg navbar-transparent ">
    <a class="navbar-brand" href="{{url('/')}}"><img src="logojog.png" alt=""></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a href="{{url('/')}}"> <img src="foto/logo.png" width="200px" alt=""> </a>
        </li>

        <li class="nav-item">
          <h1 style="position: absolute; left:200px; top:40px;">JuPark</h1>
        </li>

        @if ($resulmain != null)
        @if ($resulmain[0]->role == "admin")

        <li style="position: absolute;left:1300px; top:4px;" class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Admin
          </a>

          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="{{url('/tambah_produk')}}">Tambah Parkiran</a>
            <a class="dropdown-item" href="{{url('/hapusedit_produk')}}">Hapus / Edit Parkiran</a>
            <a class="dropdown-item" href="{{url('/lihat_bukti_pembayaran')}}">Lihat Bukti Pembayaran</a>
            <a class="dropdown-item" href="{{url('/lihat_feedback')}}">Lihat Feedback</a>
          </div>
        </li>
        @endif
        @endif
      </ul>

      <form class="form-inline my-2 my-lg-0" action="{{url('/search')}}" method="get">
        @if ($resulmain != null)
        @else

        <a href="{{url('/login')}}" type="submit" style="padding-right:10px;">Login</a>
        <a href="{{url('/register')}}" type="submit">Register</a>
        @endif
        @csrf
        <li style="position: absolute;left:1400px;top:10px;" class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
            @if ($resulmain != null)
            @if ($resulmain[0]->role == "admin")
            <img style="position: absolute;left:1450px;top:40px;" width=" 50px" alt="" src="foto/admin.png"> <span class="sr-only">(current)</span>Akun Saya</a>
          <ul class="dropdown-menu">
            <li><a href="{{url('/profile')}}">Profile</a></li>
            <li><a href="{{url('/keranjang')}}">Booking</a></li>
            <li><a href="{{url('/lihat_bukti_teracc')}}">Konfirmasi</a></li>
            <li><a href="{{url('/logout')}}">Keluar</a></li>
          </ul>
        </li>
        @else
        <img style="position:absolute;left:1450px;top:40px;" width="50px" alt="" src="foto/guest.png"> <span class="sr-only">(current)</span>Akun Saya</a>
        <ul class="dropdown-menu">
          <li><a href="{{url('/profile')}}">Profile</a></li>
          <li><a href="{{url('/keranjang')}}">Booking</a></li>
          <li><a href="{{url('/lihat_bukti_teracc')}}">Konfirmasi</a></li>
          <li><a href="{{url('/logout')}}">Keluar</a></li>
        </ul>
        </li>
        @endif
        @endif
      </form>
    </div>
  </nav>

  @yield("content2")

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').dataTable({
        "aLengthMenu": [
          [1, 50, 75, -1],
          [1, 50, 75, "All"]
        ],
        "iDisplayLength": 1
      });
    });
  </script>
</body>
@endif

</html>