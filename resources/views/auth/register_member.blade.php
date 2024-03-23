<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/assets/output.css">
    <title>Register Page</title>
</head>

<div class="flex py-10 md:py-20 px-5 md:px-32 bg-gray-200 min-h-screen">
    <div class="flex shadow w-full flex-col-reverse lg:flex-row">
        <div class="w-full lg:w-1/2 bg-white p-10 px-5 md:px-20">
            <h1 class="font-bold text-xl text-gray-700">Register Page</h1>
            <p class="text-gray-600">Please fill all column to create your account!</p>
            @if (Session::has('errors'))
                <br />
                @foreach(Session::get('errors') as $error)
                    <li style="color: red;">{{ $error[0] }}</li>
                @endforeach
            @endif
            <form action="/register_member_action" class="mt-10" method="POST">
                @csrf
                <div class="my-3">
                    <label class="font-semibold" for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" placeholder="Silahkan Masukkan Nama Lengkap" name="nama_lengkap" id="nama_lengkap"
                        class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="email">E-mail</label>
                    <input type="email" placeholder="yourmail@example.com" name="email" id="email"
                        class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                </div>
                <div class="my-3">
                    <label class="font-semibold" for="password">Password</label>
                    <input type="password" placeholder="password" name="password" id="password"
                        class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                </div>
                <div class="my-5">
                    <button type="submit"
                        class="w-full rounded-full bg-blue-400 hover:bg-blue-600 text-white py-2">REGISTER</button>
                </div>
            </form>
            <span>Have an account? <a href="/login_member" class="text-blue-400 hover:text-blue-600">Login here.</a></span>
        </div>
        <div class="w-full lg:w-1/2 bg-blue-400 flex justify-center items-center">
            <img src="/assets/register.svg" alt="Login Image" class="w-full">
        </div>
    </div>
</div>

<body>

</body>

</html>
