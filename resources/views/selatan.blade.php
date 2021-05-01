@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp
@if ($result == null)
<script type="text/javascript">
  window.location = "{{ url('/login') }}"; //here double curly bracket
</script>
@else

@extends("template/main2")
@section('content2')

<div class="container mt-5">

  <div class="col text-center">
    <h1>Parkiran Selatan</h1>
    <h3 class="text-center" style="color:cadetblue">Parkiran Bandung Selatan</h3>

  </div>
</div>
@php
$res = DB::select("select * from parkiran where kategori like '%Selatan%' and kategori like ?",["%$kategori%"]);
$resarr = $res;
@endphp
<div class="container mt-5 mb-5">
  <table id="example" class="table table-striped table-bordered" style="width:100%">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama Parkiran</th>
        <th scope="col">Harga</th>
        <th scope="col">Gambar</th>
        <th scope="col">Detail</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>

      @for ($i = 0; $i < count($resarr); $i++) <tr>
        <th scope="row">{{$i+1}}</th>
        <td>{{$resarr[$i]->nama_parkiran}}</td>
        <td>Rp.{{$resarr[$i]->harga}}</td>

        <td><img src="{{$resarr[$i]->gambar}}" width="100" height="auto"></td>
        <td>{{$resarr[$i]->detail_parkiran}}</td>
        <td>
          <form method="post" action="{{url('/beli')}}">
            @csrf
            <input type="hidden" name="id_produk" value="{{$resarr[$i]->id}}">
            <input type="hidden" name="id_pembeli" value="{{$result[0]->id}}">
            @if (strpos($resarr[$i]->kategori, "reserved") !== false)
            <h3>Sudah Full</h3>
            @else
            <button type="submit" class="btn btn-primary">Pilih</button>

          </form>
          @endif
        </td>

        </tr>

        @endfor
    </tbody>
  </table>
</div>

@endsection
@endif