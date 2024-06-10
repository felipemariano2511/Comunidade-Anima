<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidade Ânima - Login</title>
    <link rel="shortcut icon" href="../imgs/dev/login.png" type="image/x-icon">
    <link rel="stylesheet" href="../public/styles/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" href="../imgs/dev/favicon.ico" type="image/x-icon">
    <script src="https://kit.fontawesome.com/f2b509d698.js" crossorigin="anonymous"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>

    <section class="bg-gray-50 min-h-screen flex items-center justify-center">
        <!-- login container -->
        <div class="font-poppins bg-gray-100 flex rounded-2xl shadow-lg max-w-3xl p-5 mx-10 sm:flex-row w-full min-w-screen items-center">
            <!-- form -->   
            <div class="md:w-1/2 px-10">
                <div class="w-1/3 mx-auto">
                    <img src="../imgs/dev/logo-anima-1024.png" alt="" class="md:hidden rounded-2xl mx-auto">
                </div>
                <h2 class="font-bold text-2xl text-[#3C1F6E] md:block hidden">Login</h2>
                <p class="text-sm mt-4">Se você já é um membro, conecte-se</p>

                <form method="post" action="" class="flex flex-col gap-4">
                    <input class="p-2 mt-8 rounded-xl border-2 border-gray-300 focus:outline-none focus:border-[#3C1F6E] transition duration-500 ease-in-out transform" type="text" name="email" placeholder="Email">
                    <div class="relative">
                        <input class="p-2 rounded-xl border-2 border-gray-300 focus:outline-none focus:border-[#3C1F6E] transition duration-500 ease-in-out transform w-full relative" type="password" name="senha" placeholder="Senha">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray" class="bi bi-eye absolute top-1/2 right-3 -translate-y-1/2" viewBox="0 0 16 16">
                            <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                            <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                        </svg>
                    </div>
                    <button class="bg-[#3C1F6E] rounded-3xl text-white py-2 hover:scale-105 duration-300">Login</button>
                </form>
                <div class="mt-10 grid grid-cols-3 items-center text-gray-400">
                    <hr class="border-gray-400">
                    <p class="text-center text-xs">OU</p>
                    <hr class="border-gray-400">
                </div>
                <div class="mt-4 text-xs flex justify-between items-center">
                        <p>Se você não possui uma conta, entre em contato com o setor de TI do seu Campus!</p>                   
                </div>
            </div>

            <!-- img -->
            <div class="md:block hidden w-1/2 my-20 mx-auto">
                <img src="../imgs/dev/logo-anima-1024.png" alt="" class="rounded-2xl">
            </div>
        </div>
    </section>

</body>

</html>