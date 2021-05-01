@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
$bukti = DB::select('select * from bukti_pembayaran' );
@endphp
@if ($result == null)
<script type="text/javascript">
  window.location = "{{ url('/login') }}"; //here double curly bracket
</script>
@endif

@extends("template/main2")
@section('content2')
<div class="container mb-5 mt-5">
  <form method="post" action="{{url('/teracc')}}" enctype="multipart/form-data" style="position:absolute; top:100px; left:280px; width:1000px;">
    @csrf
    <table id="example" class="table table-striped table-bordered" style="width:100%">
      <thead class="thead-dark">
        <tr>
          <th scope="col">No</th>
          <th scope="col">Nama</th>
          <th scope="col">Bukti</th>
          <th scope="col">Parkiran</th>
          <th scope="col">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @for($i=0;$i<count($bukti_pembayaran);$i++) @php $produk=DB::select("select * from parkiran where id=?",[$bukti_pembayaran[$i]->id_produk])[0];
          $user = DB::select("select * from akun where id = ?", [$bukti_pembayaran[$i]->id_akun])[0];
          @endphp
          <tr>
            <th scope="row">{{$i}}</th>
            <td>{{$user->nama_lengkap}}<input name="nama_lengkap" value="{{$user->nama_lengkap}}" class="form-control" id="exampleInputEmail1" placeholder="Nama Parkiran" type="hidden"></td>
            <td>
              <img src="{{url($bukti_pembayaran[$i]->gambar)}}" width="200px" height="auto"><input name="nama_parkiran" value="{{$bukti_pembayaran[$i]->gambar}}" class="form-control" id="exampleInputEmail1" placeholder="Nama Parkiran" type="hidden">
            </td>
            <td>{{$produk->nama_parkiran}}<input name="nama_parkiran" value="{{$produk->nama_parkiran}}" class="form-control" id="exampleInputEmail1" placeholder="Nama Parkiran" type="hidden"></td>
            <td>
              <input type="hidden" name="status" value="diterima">
              <input type="hidden" name="id_produk" value="{{$produk->id}}">
              <input type="hidden" name="id" value="{{$bukti[$i]->id}}">
              <input type="hidden" name="id_akun" value="{{$user->id}}">
              @if ($bukti[$i]->status != "diterima")
              <button type="submit" class="btn btn-primary">Submit</button>
              <a href="{{url('/dteracc/'.$bukti[$i]->id)}}" class="btn btn-danger">Tolak</a>
              @endif
            </td>
          </tr>
          @endfor
      </tbody>
    </table>
  </form>

</div>

@endsection