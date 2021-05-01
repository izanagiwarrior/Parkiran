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
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat:400,400i,700,700i,600,600i">
  <link rel="stylesheet" href="assets/fonts/simple-line-icons.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.10.0/baguetteBox.min.css">
  <link rel="stylesheet" href="assets/css/smoothproducts.css">

</head>

@php
$csrf = csrf_token();
$resulmain = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp

<body style="background-image: url('foto/bg.jpg'); height: 100%;  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;">


  @yield("content")


</body>

</html>