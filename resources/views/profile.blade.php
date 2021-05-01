@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp
@if ($result == null) 
<script type="text/javascript">
  window.location = "{{ url('/login') }}";//here double curly bracket
</script>
@else
@php
    $getClient = DB::select('select * from akun where csrf = ?', [$csrf])
@endphp
@extends("template/profile")
@section('content')
<main class="page registration-page">
  <section class="clean-block clean-form">
           
               
    <br>
    <form method="post"style="background-color:#E2E5E5;" action="{{url("/edit_profile")}}">
      @csrf
	  <h5 class="text-center" > Ubah </h1>
      <div class="form-group row">
        <label for="staticEmail" class="col-sm-5">Email</label>
        <div class="col-sm-12 w-100">
          <input value="{{$getClient[0]->email}}" type="text" readonly class="form-control id="staticEmail" style=" border-radius: 10px;">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputNama" class="col-sm-5">Nama</label>
        <div class="col-sm-12 w-100">
          <input name="namadd" value="{{$getClient[0]->nama_lengkap}}" class="form-control" id="nama" placeholder="Nama" style=" border-radius: 10px;">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputNoHP" class="col-sm-5">No HP</label>
        <div class="col-sm-12 w-100">
          <input name="nohp" value="{{$getClient[0]->nohp}}" class="form-control" id="nohp" placeholder="No HP" style=" border-radius: 10px;">
        </div>
      </div>
      
      <div class="form-group row">
        <label for="inputPassword" class="col-sm-3 ">Password</label>
        <div class="col-sm-12 w-100">
          <input name="password" value="" class="form-control" id="inputPassword" type="password" placeholder="Password" style=" border-radius: 10px;">
        </div>
      </div>
      <div class="form-group row">
        <label for="inputPasswordC" class="col-sm-5 ">Password Confirm</label>
        <div class="col-sm-12 w-100">
          <input name="passwordc" class="form-control" id="inputPasswordC" type="password" placeholder="Password Confirm"style=" border-radius: 10px;">
        </div>
      </div>
      <button class="btn btn-primary w-100" style="background-color:#597882;border-radius: 10px; ">Ubah</button>
	  <br><br>
      <a href="{{url("/")}}" class="btn btn-light w-100"style=" border-radius: 10px;">Cancel</a>
    </form>
      </div>
        </section>
    </main>
  @endsection
  @endif
