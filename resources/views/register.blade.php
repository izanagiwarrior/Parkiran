@extends("template/register")
@section("content")


<?php
if (strlen(app('request')->input("message")) > 0) {
    echo '<div class="alert alert-success">' . app('request')->input("message") . '</div>';
}
?> <main class="page registration-page">
    <section class="clean-block clean-form">

        <br>
        <form action="<?php echo url('/register_acc'); ?>" style="background-color:#E2E5E5;
height:660px;
 margin: auto;
 position: relative;" method="POST">
            @csrf

            <h5 class="text-center">Registrasi</h5>
            <label for="name">Nama</label><input class="form-control item" type="text" name="nama" style=" border-radius: 10px;">
            <label for="name">Email</label><input class="form-control item" type="text" name="email" style=" border-radius: 10px;">
            <label for="name">Username</label><input class="form-control item" type="text" name="username" style=" border-radius: 10px;" style=" border-radius: 10px;">
            <label for="password">Password</label><input class="form-control item" type="password" name="password" style=" border-radius: 10px;">
            <label for="password">Re Password</label><input class="form-control item" type="password" name="re-password" style=" border-radius: 10px;">
            <label for="name">No Hp</label><input class="form-control item" type="text" name="nohp" style=" border-radius: 10px;">
            <label for="email">Alamat</label><input class="form-control" name="alamat" style=" border-radius: 10px;"></input><br><button class="btn btn-primary btn-block" style="background-color:#597882; border-radius: 10px;" type="submit">Daftar</button>
            <a href="{{ url('/login') }}" class="text-center">Sudah punya akun</a>
        </form>
        </div>
    </section>
</main>
@endsection