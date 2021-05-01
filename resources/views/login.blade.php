@extends('template/login')
@section('content')
    <?php
  //echo '<div class="alert alert-success"></div>';
?>

       
        <section class="clean-block clean-form" >
            <div class="container"  >
                <div class="block-heading">
                    
                    
                </div>
                <form action="{{url('/login_acc')}}" method="POST" style="background-color:#E2E5E5;">
                @csrf
				<h2 class="text-center">Log In</h2>
                    <div class="form-group"><label for="email">Username</label><input class="form-control" type="text" name="username"style=" border-radius: 10px;"></div>
                    <div class="form-group"><label for="password">Password</label><input class="form-control" type="password" name="password" style=" border-radius: 10px;"></div>
                    <div class="form-group">
                        
                    </div><button class="btn btn-primary btn-block" style="background-color:#597882; border-radius: 10px;" type="submit">Log In</button>
                </form>
            </div>
        </section>
    
@endsection