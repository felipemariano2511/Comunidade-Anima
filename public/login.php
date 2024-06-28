<?php
    include '../app/includes/config.php';
    include '../app/Session/User.php';
    use App\Session\User as SessionUser;

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])){
        $email = $_POST['email'];
        $senha = md5($_POST['senha']);

        $query = "SELECT * FROM usuario WHERE email='$email' AND senha='$senha'";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0){
            SessionUser::login($email);
            
            include '../app/includes/get_dados_usuario.php';
            
            header("Location: index.php");

        } else{
            echo '<script>alert("Email ou senha inválidos! Por favor, verifique e tente novamente.")</script>';
        }

    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comunidade Ânima - Login</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
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

                <form method="post" class="flex flex-col gap-4">
                    <input class="p-2 mt-8 rounded-xl border-2 border-gray-300 focus:outline-none focus:border-[#3C1F6E] transition duration-500 ease-in-out transform" type="text" name="email" maxlength="50" placeholder="Email">
                    <div class="relative">
                        <input id="senhaInput" class="p-2 rounded-xl border-2 border-gray-300 focus:outline-none focus:border-[#3C1F6E] transition duration-500 ease-in-out transform w-full relative"type="password" name="senha" placeholder="Senha">
                        <i id="hidePassword" class='bx bx-hide absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
                        <i id="showPassword" class='bx bx-show hidden absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400'></i>
                    </div>
                    <button class="bg-[#3C1F6E] rounded-3xl text-white py-2 hover:scale-105 duration-300" name="login">Login</button>
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
    <script>
        // Capturando os elementos relevantes
        const senhaInput = document.getElementById('senhaInput');
        const showPasswordIcon = document.getElementById('showPassword');
        const hidePasswordIcon = document.getElementById('hidePassword');

        // Função para alternar a visibilidade da senha
        function togglePasswordVisibility() {
            if (senhaInput.type === 'password') {
                senhaInput.type = 'text';
                hidePasswordIcon.classList.add('hidden');
                showPasswordIcon.classList.remove('hidden');
            } else {
                senhaInput.type = 'password';
                hidePasswordIcon.classList.remove('hidden');
                showPasswordIcon.classList.add('hidden');
            }
        }

        // Adicionando eventos de clique nos ícones
        hidePasswordIcon.addEventListener('click', togglePasswordVisibility);
        showPasswordIcon.addEventListener('click', togglePasswordVisibility);
    </script>


</body>

</html>