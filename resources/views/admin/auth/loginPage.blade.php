<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  @vite('resources/css/app.css')
  @include('\font\poppins')
  <title>Login Admin | Lobi Poliwangi</title>
</head>
<body>
  <!-- navbarTransparent -->
  @include('\component\navbarTransparant')
  <!-- boxLogin -->
  <div class="p-7 absolute z-20 inset-y-[23%] inset-x-[21rem] w-6/12 bg-slate-50/5 border-2 rounded-lg backdrop-blur-sm">
    <!-- formInputAuth -->
    <form action="/login-admin" method="post">
      @csrf
      <p class="font-poppins text-4xl font-bold text-slate-50 -mt-4">Login Admin</p>
      <!-- kolomPengisianForm -->
      <div class="flex flex-col mt-9">
        <label for="username" class="font-poppins text-md font-normal text-slate-50">Username</label>
        <input name="username" type="text" class="w-72 bg-transparent outline-0 border-b-2 mt-1 text-slate-50">
      </div>
      <div class="flex flex-col mt-5">
        <label for="username" class="font-poppins text-md font-normal text-slate-50">Password</label>
        <input name="password" type="password" class="w-72 bg-transparent outline-0 border-b-2 mt-1 text-slate-50">
      </div>
      <!-- buttonLogin -->
      <div class="w-full flex justify-center mt-12">
        <button type="submit" class="w-[96%] h-fit p-2 bg-sky-500 text-white font-normal rounded-md">Login</button>
      </div>
    </form>
  </div>
  <!-- layoutImage -->
  <div class="bg-black opacity-60 absolute z-0 inset-x-0 inset-y-0"></div>
  <!-- imageBackgroundLayout -->
  <div class="w-full h-screen">
    <img class="w-full h-full" src="\data\img\aulaAzwarAnnas.jpg">
  </div>

  <!-- Message Salah Kredensial -->
  @if (session()->has('authGagal'))
    <script>alert('{{ session('authGagal') }}')</script>
  @endif
</body>
</html>