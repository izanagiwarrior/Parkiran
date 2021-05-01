@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp


@php
$csrf = csrf_token();
$resulmain = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp

@if ($resulmain != null)
@extends("template/main2")
@section('content2')
<br>
<div class="">
  <div class="container" style="">
    <div class="row">
      <div class="pb-5 pt-5 col bg-transparent  ">
        <h2 style="text-align:left; ">Solusi Mencari Parkir Anda</h2>
        <p style="text-align:left;"><b><i>Cari Parkir, Booking Parkir, Booking Valey<br>Semua bisa, hanya di JuPark!</i></b></p>
        
        <form action="{{route("cari")}}">
          <div class="d-flex justify-content-center">
            <select name="forma">
              <option value="">Klik Disini</option>
              <option value="barat">Bandung Barat</option>
              <option value="utara">Bandung Utara</option>
              <option value="selatan">Bandung Selatan</option>
            </select>
            <div class="form-check ml-3 mt-2">
              <input name="kategori" class="form-check-input" type="radio" id="esxampleRadios1" value="" checked>
              <label class="form-check-label" for="esxampleRadios1">
                Semua
              </label>
            </div>
            <div class="form-check ml-3 mt-2">
              <input name="kategori" class="form-check-input" type="radio" id="exampleRadios1" value="reserved" >
              <label class="form-check-label" for="exampleRadios1">
                Reserved
              </label>
            </div>
            <div class="form-check ml-3 mt-2">
              <input name="kategori" class="form-check-input" type="radio" id="aexampleRadios1" value="kosong">
              <label class="form-check-label" for="aexampleRadios1">
                Kosong
              </label>
            </div>
            <button type="submit" class="ml-3 shadow btn btn-warning">Cari</button>
          </div>
        </form>

      </div>
      <div class="w-100">

      </div>
      <br><br>


@else
@extends("template/main")
@section('content')
<main class="page registration-page">
        <section class="clean-block clean-form">
            <div class="container">
                <div class="block-heading">
                    
                    
                </div>
<center>
        
  
        <table>
            <tr>
                <th colspan="2"><h1 class="text-center">Hello!<br>Pilih Parkiran Sesukamu, enjoy your parking!!</h1></th>
            </tr>
			<tr>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td></td>
			<td></td>
			</tr>
			<tr>
			<td></td>
			<td></td>
			</tr>
            <tr>
                <td><center> <a href="{{url("/login")}}" class="btn btn-primary btn-block" style="background-color: Transparent;border-radius: 10px; width:200px; color:black;">Log In</a><center></td>
                <td><center> <a href="{{url("/register")}}" class="btn btn-primary btn-block" style="background-color: Transparent;border-radius: 10px; width:200px; color:black;">Register</a></center></td>
				 
            </tr>
  
        </table>
</center>
</div>
        </section>
    </main>
@endif

@endsection