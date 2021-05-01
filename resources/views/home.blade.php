@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp
@extends("template/main2")
@section('content')



<br>
<div class="">
  <div class="container shadow">
    <div class="row">
      <div class="pb-5 pt-5 col bg-light text-center shadow" style="background-image: url(batik.jpg);">
        <h2 style="text-shadow: 3px 2px 15px black; color: #ffe68a; font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">JuPark</h2>
        <p style="text-shadow: 3px 2px 15px black; color:white;"><b><i>Cari Parkiran Terdekat</i></b></p>

        <form action="{{route('cari')}}">
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
              <input name="kategori" class="form-check-input" type="radio" id="exampleRadios1" value="reserved">
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
      @php
      $merch = DB::select("select * from parkiran where kategori like ?", ["%merchandise%"]);
      @endphp
      @for ($i = 0; $i < count($merch); $i++) <div class="col p-4" style="background-color: rgb(248, 248, 248);">
        <img class="w-100 shadow" style="border-radius: 25px;" src="{{url($merch[$i]->gambar)}}">
        <div class="pl-3 pr-3 h-100">
          <p class="mt-3 font-weight-bold">{{$merch[$i]->nama_parkiran}}</p>
          <p></p>
          <hr>
          <p>Rp.{{$merch[$i]->harga}}
          <p>
          <form action="{{url('/beli')}}" method="post">
            @csrf
            <input type="hidden" name="id_produk" value="{{$merch[$i]->id}}">
            @if ($result != null)
            <input type="hidden" name="id_pembeli" value="{{$result[0]->id}}">
            @endif
            <button type="submit" name="barang" value="1" class="btn btn-warning">Pilih</button>
            <button type="button" class="btn btn btn-info" data-toggle="modal" data-target="#myModal{{$i}}">
              Detail Parkiran
            </button>
          </form>
          <div id="myModal{{$i}}" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- konten modal-->
              <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                  <h4 class="modal-title ">Detail Parkiran</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                  <p>{{$merch[$i]->detail_parkiran}}</p>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
                </div>
              </div>
            </div>
          </div>

        </div>

    </div>
    @endfor

  </div>


</div>


<div class="container mt-5">
  <div class="container">
  </div>
  <div class="row">
    <div class="col text-center">
      <h1><i> Parkiran Kosong</i></h1>
      <h3 class="text-center" style="color: red;">Kosong</h3>
      <br><br>
    </div>
  </div>
  <!-- jika ingin membuat card dibaris dua, copy row sampai div kedua terakhir -->
  <div class="row">
    @php
    $bess = DB::select('select * from parkiran where kategori like ?', ["%kosong%"]);
    @endphp
    @for ($i = 0; $i < count($bess); $i++) <div class="col-md">
      <!-- tidak perlu pakai width, karena agar menyesuaikan dengan gambar lain di smapingnya -->
      <div class="card"">
        <img src=" {{$bess[$i]->gambar}}" width="200px" height="auto" class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">{{$bess[$i]->nama_parkiran}}</h5>
          <p class="card-text">Rp.{{$bess[$i]->harga}}</p>
          <form action="{{url('/beli')}}" method="post">
            @csrf
            <input type="hidden" name="id_produk" value="{{$bess[$i]->id}}">

            @if ($result != null)
            <input type="hidden" name="id_pembeli" value="{{$result[0]->id}}">
            @endif
            <button type="submit" name="barang" value="1" class="btn btn-warning">Pilih</button>
            <button type="button" class="btn btn btn-info" data-toggle="modal" data-target="#myModal{{$i}}b">
              Detail Parkiran
            </button>
          </form>
          <div id="myModal{{$i}}b" class="modal fade" role="dialog">
            <div class="modal-dialog">
              <!-- konten modal-->
              <div class="modal-content">
                <!-- heading modal -->
                <div class="modal-header">
                  <h4 class="modal-title ">Detail Parkiran</h4>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- body modal -->
                <div class="modal-body">
                  <p>{{$bess[$i]->detail_parkiran}}</p>
                </div>
                <!-- footer modal -->
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Tutup Modal</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>
  @endfor
</div>
</div><br><br>


@endsection