@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp
@if ($result == null)
<script type="text/javascript">
    window.location = "{{ url('/login') }}"; //here double curly bracket
</script>
@else
@php
$getClient = DB::select('select * from akun where csrf = ?', [$csrf])
@endphp
@extends("template/profile")
@section('content')

<style>
    .rate {
        height: 50px;
        padding: 0 10px;
        width: fit-content;
    }

    .rate:not(:checked)>input {
        position: absolute;
        top: -9999px;
    }

    .rate:not(:checked)>label {
        float: right;
        width: 1.8em;
        overflow: hidden;
        white-space: nowrap;
        cursor: pointer;
        font-size: 30px;
        color: #ccc;
        margin: 0 15px;
    }

    .rate:not(:checked)>label:before {
        content: '★ ';
    }

    .rate>input:checked~label {
        color: #ffc700;
    }

    .rate:not(:checked)>label:hover,
    .rate:not(:checked)>label:hover~label {
        color: #deb217;
    }

    .rate>input:checked+label:hover,
    .rate>input:checked+label:hover~label,
    .rate>input:checked~label:hover,
    .rate>input:checked~label:hover~label,
    .rate>label:hover~input:checked~label {
        color: #c59b08;
    }

    .profile-img {
        border-radius: 50%;
        background-color: blue;
        width: 150px;
        height: 150px;
        position: relative;
        top: -90px;
        left: 100px;
        border: 5px solid #fff
    }
</style>

<main class="page registration-page">
    <section class="clean-block clean-form">


        <br>
        <form method="post" style="background-color:#E2E5E5;" action="{{url('/feedback')}}">
            @csrf
            <h5 class="text-center"> Feedback </h1>
                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-5">Email</label>
                    <div class="col-sm-12 w-100">
                        <input value="{{$getClient[0]->email}}" type="text" readonly class="form-control id=" staticEmail" style=" border-radius: 10px;">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNama" class="col-sm-5">Nama</label>
                    <div class="col-sm-12 w-100">
                        <input name="namadd" value="{{$getClient[0]->nama_lengkap}}" readonly class="form-control" id="nama" placeholder="Nama" style=" border-radius: 10px;">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNoHP" class="col-sm-5">No HP</label>
                    <div class="col-sm-12 w-100">
                        <input name="nohp" value="{{$getClient[0]->nohp}}" readonly class="form-control" id="nohp" placeholder="No HP" style=" border-radius: 10px;">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputNoHP" class="col-sm-5">Rating</label>
                    <div class="rate mx-auto">
                        <input type="radio" id="star5" name="rating" value="5" />
                        <label for="star5" title="text">5</label>
                        <input type="radio" id="star4" name="rating" value="4" />
                        <label for="star4" title="text">4</label>
                        <input type="radio" id="star3" name="rating" value="3" />
                        <label for="star3" title="text">3</label>
                        <input type="radio" id="star2" name="rating" value="2" />
                        <label for="star2" title="text">2</label>
                        <input type="radio" id="star1" name="rating" value="1" />
                        <label for="star1" title="text">1</label>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="feedback" class="col-sm-5">Feeback</label>
                    <div class="col-sm-12 w-100">
                        <textarea id="feedback" name="feedback" rows="4" cols="44" required></textarea>
                    </div>
                </div>
                <button class="btn btn-primary w-100" style="background-color:#597882;border-radius: 10px; ">Submit</button>
                <br><br>
                <a href="{{url('/')}}" class="btn btn-light w-100" style=" border-radius: 10px;">Skip</a>
        </form>
        </div>
    </section>
</main>
<script>
    var logID = 'log',
        log = $('<div id="' + logID + '"></div>');
    $('body').append(log);
    $('[type*="radio"]').change(function() {
        var me = $(this);
        log.html(me.attr('value'));
    });
</script>
@endsection
@endif