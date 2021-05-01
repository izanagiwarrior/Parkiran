@php
$csrf = csrf_token();
$result = DB::select('select * from akun where csrf = ?', [$csrf]);
@endphp
@extends("template/main")
@section('content')
<main class="page registration-page">
        <section class="clean-block clean-form">
            <div class="container">
                <div class="block-heading">
                    
                    
                </div>
<center>
        
  
        <table>
            <tr>
                <th colspan="2"><h1 class="text-center">Hello!<br>Pilih Parkiran Sesukamu, enjoy your parking!!</h1></th>
            </tr>
  
            <tr>
                <td><center> <a href="{{url("/login")}}" class="btn btn-primary btn-block" style="background-color:#597882; border-radius: 10px; width:200px;">Log In</a><center></td>
                <td><center> <a href="{{url("/register")}}" class="btn btn-primary btn-block" style="background-color:#597882; border-radius: 10px; width:200px;">Register</a></center></td>
				 
            </tr>
  
        </table>
</center>
</div>
        </section>
    </main>
@endsection