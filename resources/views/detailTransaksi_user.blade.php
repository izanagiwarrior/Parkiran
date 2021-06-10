@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
$bukti = DB::select('select * from bukti_pembayaran' );
$akun = DB::select('select * from teracc' );
$product = DB::select('select * from parkiran' );
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
                <th scope="col">Parkiran</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($akun as $index)
            @if($index->id_akun == $id)
            <tr>
                <th scope="row">{{$i}}</th>
                @foreach($product as $pd)
                @if($pd->id == $index->id_produk)
                <td>{{$pd->nama_parkiran}}</td>
                @endif
                @endforeach
                <td>
                    @if(is_null($index->status))
                    Menuju Lokasi
                    @else
                    {{$index->status}}
                    @endif
                </td>
                <td>
                    @if($index->status == "Parkir Selesai")
                    Transaksi Selesai
                    @else
                    <form action="{{ route('trackingTeracc') }}" method="post">
                        @csrf
                        <input type="hidden" value="{{ $index->id }}" name="id">
                        <button class="btn btn-success">{{"Process"}}</button>
                    </form>
                    @endif
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