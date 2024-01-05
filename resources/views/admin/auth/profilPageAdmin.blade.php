<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite('resources/css/app.css')
    @include('\font\poppins')
    <title>My Profile | Lobi Poliwangi</title>
</head>
<body>
    <!-- Flexing Sidebar dan Body -->
    <div class="flex flex-row h-fit">
    <!-- Sidebar Admin -->
    @include('\admin\component\sidebar')
    <!-- Bagian Body -->
    <div class="pl-64 pr-6 pt-3 w-full h-full">
        <div class="w-full h-96 bg-slate-200 pt-10 flex flex-col justify-center items-center">
            <div class="w-full h-fit flex justify-center">
                <div class="flex flex-col">
                    <div class="w-36 h-36 rounded-full bg-black"></div>
                    <p><center class="text-2xl font-bold mt-4">{{ $dataAccount->username }}</center></p>
                    <p><center class="text-base font-normal mt-1">ID: {{ $dataAccount->id }}</center></p>
                </div>
            </div>
            <a href="/my-profile/logout-admin" class="w-10/12 h-fit flex flex-row justify-center p-2 bg-red-700 mt-4 rounded-md text-white font-semibold hover:bg-red-600">Log Out Account</a>
        </div>
    </div>
    </div>
    @if (session()->has('successAddedData'))
    <script>alert('{{ session("successAddedData") }}')</script>
    @endif
    @if (session()->has('dataSuccessDeleted'))
    <script>alert('{{ session("dataSuccessDeleted") }}')</script>
    @endif
</body>
</html>