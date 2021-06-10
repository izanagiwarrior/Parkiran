@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
$bukti = DB::select('select * from bukti_pembayaran' );
$akun = DB::select('select * from akun' );
$i = 1
@endphp
@if ($result == null)
<script type="text/javascript">
    window.location = "{{ url('/login') }}"; //here double curly bracket
</script>
@endif

@extends("template/main2")
@section('content2')
<div class="container mb-5 mt-5">
    <table id="example" class="table table-striped table-bordered" style="width:100%">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No</th>
                <th scope="col">Username</th>
                <th scope="col">Nama Lengkap</th>
                <th scope="col">Email</th>
                <th scope="col">No Handphone</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($akun as $index)
            @if($index->role == "klien" || $index->role == "user" || $index->role == "pengguna")
            <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$index->username}}</td>
                <td>{{$index->nama_lengkap}}</td>
                <td>{{$index->email}}</td>
                <td>{{$index->nohp}}</td>
                <td>
                    <a href="{{ route('detailTransaksi_user',$index->id) }}" class="btn btn-block btn-warning">Detail</a>
                </td>
            </tr>
            @php
            $i += 1
            @endphp
            @endif
            @endforeach
        </tbody>
    </table>

</div>

@endsection