
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Register Akun</title>
</head>
<body>
    <div class="container" style="margin-top:80px">
        <div class="row">
            <div class="col-md-5 offset-md-3">
                <div class="card">
                    <div class="card-body">
                        <label for="">register</label>
                        <hr>
                        <div class="form-group">
                            <label for="namaLengkap">Nama Lengkap</label>
                            <input type="text" id="namaLengkap" name="namaLengkap" placeholder="Masukan Nama..." class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email">email</label>
                            <input type="text" id="email" name="email" placeholder="Masukan Email..." class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="password">password</label>
                            <input type="text" id="password" name="password" placeholder="Masukan password..." class="form-control">
                        </div>

                        <button class="btn btn-register btn-block btn-success">registrasi</button>
                    </div>
                </div>
                <div class="text-center">Sudah punya akun?<a href="/login">silahkan login</a></div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" ></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script>

    <script>
        $(document).ready(function(){
            $(".btn-register").click(function(){
                var namaLengkap = $("#namaLengkap").val();
                var email    = $("#email").val();
                var password = $("#password").val();
                var token = $("meta[name='csrf-token']").attr("content");

                if(namaLengkap.length==''){
                    Swal.fire({
                        type : "warning",
                        title : "Ooops",
                        text : "nama lengkap wajib diisi",
                    })
                } else if(email.length==''){
                    Swal.fire({
                        type : "warning",
                        title : "Ooops",
                        text : "email wajib diisi",
                    })
                } else if(password.length=''){
                    Swal.fire({
                        type : "warning",
                        title : "Ooops",
                        text : "password wajib diisi",
                    })
                } else {
                    $.ajax({
                        url: "{{ route('register.store') }}",
                        type: "POST",
                        cache : false,
                        data : {
                            "namaLengkap" : namaLengkap,
                            "email" : email,
                            "password" : password, 
                            "_token": token,
                        }, 
                        // respon dari controller register
                        success:function(response){
                            if(response.success){
                                Swal.fire({
                                    type:"success",
                                    title:"Register Berhasil!!",
                                    text:"Silahkan Login",
                                });

                                $('#namaLengkap').val('');
                                $('#username').val('');
                                $('#password').val('');
                            } else {
                                Swal.fire({
                                    type:"error",
                                    title:"Register Gagal!!",
                                    text:"Silahkan Coba Lagi",
                                });
                            }
                            console.log(response);
                        },
                        // Jika gagal dari server database
                        error:function(response){
                            Swal.fire({
                                type:"error",
                                    title:"Ooops",
                                    text:"Server Error!",
                            });
                            console.log(response);
                            }
                    })
                }
            });
        })
    </script>
</body>
</html>