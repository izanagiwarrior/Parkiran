@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp
@if ($result == null)
<script type="text/javascript">
  window.location = "{{ url('/login') }}"; //here double curly bracket
</script>
@endif

@extends('template/main2')
@section('content2')
<div class="container mt-5 mb-5">
  <form method="post" action="{{url('/produk/tambah')}}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
      <label for="exampleInputEmail1">Nama Parkiran</label>
      <input name="nama_parkiran" class="form-control" id="exampleInputEmail1" placeholder="Nama Parkiran">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Harga</label>
      <input name="harga" class="form-control" id="exampleInputEmail1" placeholder="Harga">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Kategori</label>
      <input name="kategori" class="form-control" id="exampleInputEmail1" placeholder="Kategori">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Lat</label>
      <input name="lat" class="form-control" id="exampleInputEmail1" placeholder="Nama Parkiran">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Lang</label>
      <input name="lang" class="form-control" id="exampleInputEmail1" placeholder="Nama Parkiran">
    </div>
    <div class="form-group">
      <label for="exampleFormControlTextarea1">Detail Parkiran</label>
      <textarea name="detail_parkiran" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <div class="form-group">
      <label for="exampleFormControlFile1">Gambar</label>
      <input type="file" name="gambar" class="form-control-file" id="exampleFormControlFile1">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>
@endsection