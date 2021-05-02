@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
$bukti = DB::select('select * from bukti_pembayaran' );
$feedback = DB::select('select * from feedback' );
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
                <th scope="col">Nama</th>
                <th scope="col">Parkiran</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($feedback as $index)
            <tr>
                <th scope="row">{{$i}}</th>
                <td>{{$index->nama_lengkap}}</td>
                <td>{{$index->feedback}}</td>
            </tr>
            @php
            $i += 1
            @endphp
            @endforeach
        </tbody>
    </table>

</div>

@endsection