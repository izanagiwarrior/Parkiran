@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);

$parkiran = DB::select('select * from parkiran');
$data = DB::select('SELECT id_produk,COUNT(id_produk) jumlah_produk FROM teracc GROUP BY id_produk;');

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
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Parkiran</th>
                <th scope="col" class="text-center">Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($parkiran as $index)
            @if(strpos($index->nama_parkiran, 'ley'))
            <tr>
                <th scope="row" class="text-center">{{$i}}</th>
                <td class="text-center">{{$index->nama_parkiran}}</td>
                <td class="text-center">
                    @foreach($data as $dt)
                    @if($index->id == $dt->id_produk)
                    <?php
                    $lol = 0;
                    ?>
                    @foreach ($dt as $dtt)
                    @if ($lol == 1)
                    <p>{{$dtt}} Transaksi</p>
                    @endif
                    <?php
                    $lol += 1;
                    ?>
                    @endforeach
                    @endif
                    @endforeach
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