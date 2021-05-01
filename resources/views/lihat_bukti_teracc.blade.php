@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp
@if ($result == null) 
<script type="text/javascript">
  window.location = "{{ url('/login') }}";//here double curly bracket
</script>
@endif

@extends("template/main2")
@section('content2')
<div class="container mb-5 mt-5">

    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="thead-dark">
          <tr>
            <th scope="col">#</th>
            <th scope="col">Nama</th>
           
            <th scope="col">Parkiran</th>
            
          </tr>
        </thead>
        <tbody>
        @for($i=0;$i<count($bukti_pembayaran);$i++)
        @php
        $produk = DB::select("select * from parkiran where id = ?",[$bukti_pembayaran[$i]->id_produk])[0];   
        $user = DB::select("select * from akun where id = ?", [$bukti_pembayaran[$i]->id_akun])[0];
        @endphp
          <tr>
            <th scope="row">{{$i}}</th>
            <td>{{$user->nama_lengkap}}<input name="nama_lengkap" value="{{$user->nama_lengkap}}" class="form-control" id="exampleInputEmail1" placeholder="Nama Parkiran" type="hidden" ></td>
           
            <td>{{$produk->nama_parkiran}}<input name="nama_parkiran" value="{{$produk->nama_parkiran}}" class="form-control" id="exampleInputEmail1" placeholder="Nama Parkiran"type="hidden"></td>
            
          </tr>
        @endfor
        </tbody>
      </table>
	
</div>
@endsection