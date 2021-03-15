<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login akun</title>
</head>
<body>
    <div class="container" style="margin-top:80px;">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <label for="">Login</label>
                        <hr>
                        <div class="form-group">
                            <label for="email">Alamat email </label>
                            <input type="text" class="form-control" name="email" id="email" placeholder="Masukan Alamat Email...">
                        </div>
                        <div class="form-group">
                            <label for="password">Password  </label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Masukan Password...">
                        </div>
                        <button class="btn btn-login btn-block btn-success">login</button>
                    </div>
                </div>
                <div class="text-center">
                    Belum punya akun? <a href="/register">Silahkan register</a>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function(){
            $('.btn-login').click(function(){
                var email = $('#email').val();
                var password = $('#password').val();
                var token = $("meta[name='csrf-token']").attr('content');

                if(email.length==''){
                    Swal.fire({
                        type:"warning",
                        title:"Ooops..",
                        text:"Alamat Email Wajib Diisi !",
                    });
                }else if(password.length==''){
                    Swal.fire({
                        type:"warning",
                        title:"Ooops..",
                        text:"Password wajib diisi",
                    })
                } else {
                    $.ajax({
                        url : "{{ route('login.checkLogin') }}",
                        type : "POST",
                        dataType : "JSON", 
                        cache : false,
                        data:{
                            "email":email,
                            "password":password,
                            "_token": token
                        }, 

                        success:function (response){
                            if (response.success){
                                Swal.fire({
                                    type:"success",
                                    title: "Login Berhasil!!!",
                                    text : "Anda akan diarahkan dalam 3 detik",
                                    timer : 3000,
                                    showCancelButton : false,
                                    showConfirmButton : false
                                }).then(function(){
                                    window.location.href="{{ route('dashboard.index') }}";
                                });
                            } 
                        },

                        error:function(response){
                            Swal.fire({
                                type:"error",
                                title:"Login Gagal!",
                                text:"Silahkan Coba Lagi",
                            })
                            console.log(response);
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>