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
    @import "compass/css3";

    $unchecked-star: '\2606';
    $unchecked-color: #888;
    $checked-star: '\2605';
    $checked-color: #e52;

    .star-cb-group {
        /* remove inline-block whitespace */
        font-size: 0;

        * {
            font-size: 1rem;
        }

        /* flip the order so we can use the + and ~ combinators */
        unicode-bidi: bidi-override;
        direction: rtl;

        &>input {
            display: none;

            &+label {
                /* only enough room for the star */
                display: inline-block;
                overflow: hidden;
                text-indent: 9999px;
                width: 1em;
                white-space: nowrap;
                cursor: pointer;

                &:before {
                    display: inline-block;
                    text-indent: -9999px;
                    content: $unchecked-star;
                    color: $unchecked-color;
                }
            }

            &:checked~label:before,
            &+label:hover~label:before,
            &+label:hover:before {
                content: $checked-star;
                color: #e52;
                text-shadow: 0 0 1px #333;
            }
        }

        /* the hidden clearer */
        &>.star-cb-clear+label {
            text-indent: -9999px;
            width: .5em;
            margin-left: -.5em;
        }

        &>.star-cb-clear+label:before {
            width: .5em;
        }

        &:hover>input+label:before {
            content: $unchecked-star;
            color: $unchecked-color;
            text-shadow: none;
        }

        &:hover>input+label:hover~label:before,
        &:hover>input+label:hover:before {
            content: $checked-star;
            color: $checked-color;
            text-shadow: 0 0 1px #333;
        }
    }

    // extra styles
    :root {
        font-size: 2em;
        font-family: Helvetica, arial, sans-serif;
    }

    body {
        background: #333;
        color: $unchecked-color;
    }

    fieldset {
        border: 0;
        background: #222;
        width: 5em;
        border-radius: 1px;
        padding: 1em 1.5em 0.9em;
        margin: 1em auto;
    }

    #log {
        margin: 1em auto;
        width: 5em;
        text-align: center;
        background: transparent;
    }

    h1 {
        text-align: center;
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
                    <label for="inputNoHP" class="col-sm-5">No HP</label>
                    <fieldset>
                        <span class="star-cb-group">
                            <input type="radio" id="rating-5" name="rating" value="5" /><label for="rating-5">5</label>
                            <input type="radio" id="rating-4" name="rating" value="4" checked="checked" /><label for="rating-4">4</label>
                            <input type="radio" id="rating-3" name="rating" value="3" /><label for="rating-3">3</label>
                            <input type="radio" id="rating-2" name="rating" value="2" /><label for="rating-2">2</label>
                            <input type="radio" id="rating-1" name="rating" value="1" /><label for="rating-1">1</label>
                            <input type="radio" id="rating-0" name="rating" value="0" class="star-cb-clear" /><label for="rating-0">0</label>
                        </span>
                    </fieldset>
                    </div>
                    <div class="form-group row">
                        <label for="feedback" class="col-sm-5">Feeback</label>
                        <div class="col-sm-12 w-100">
                            <textarea id="feedback" name="feedback" rows="4" cols="44"></textarea>
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