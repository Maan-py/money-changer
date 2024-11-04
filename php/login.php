<?php
include "koneksi.php";
session_start();

if (isset($_SESSION["status"]) && $_SESSION["status"] == "login") {
    if ($_SESSION["role"] == "Admin") {
        header("Location: dashboard.php");
    } else {
        header("Location: user.php");
    }
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $data = mysqli_query($connect, $query) or die(mysqli_error($connect));

    $jumlahData = mysqli_num_rows($data);

    if ($jumlahData > 0) {
        $row = mysqli_fetch_assoc($data);

        if (password_verify($password, $row["password"])) {
            $_SESSION["username"] = $username;
            $_SESSION["status"] = "login";
            $_SESSION["id_user"] = $row["id_user"];
            if ($row["user_role"] == "Admin") {
                $_SESSION["role"] = "Admin";
                header("Location: dashboard.php");
                exit;
            } else {
                $_SESSION["role"] = "User";
                header("Location: user.php");
                exit;
            }
        } else {
            $_SESSION['error_message'] = "username atau password salah.";
            header("Location: login.php");
            exit;
        }
    } else {
        $_SESSION['error_message'] = "username atau password salah.";
        header("Location: login.php");
        exit;
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.13/dist/full.min.css" rel="stylesheet" type="text/css" />
</head>

<body class="flex items-center justify-center min-h-screen bg-gray-50 dark:bg-gray-900 flex-col">
    <?php
    if (isset($_SESSION['error_message'])) {
        echo '<div role="alert" class="alert alert-error w-1/4 fixed top-2 justify-center mt-5" id="pesan_gagal">
                <svg id="silang"
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 shrink-0 stroke-current cursor-pointer"
                    fill="none"
                    viewBox="0 0 24 24">
                    <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M6 18L18 6M6 6l12 12" />
                </svg>
                <span>' . $_SESSION['error_message'] . '</span>
                </div>';
        unset($_SESSION['error_message']);
    }
    ?>
    <section class="w-full max-w-md">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1
                        class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" action="login.php" method="post">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                username</label>
                            <input type="username" name="username" id="username"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••"
                                class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                required="">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" aria-describedby="remember" type="checkbox"
                                        class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                            <a href="#"
                                class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500">Forgot
                                password?</a>
                        </div>
                        <button type="submit"
                            class="w-full btn btn-primary  hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">Sign
                            in</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? <a href="register.php"
                                class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script>
        const pesanGagal = document.getElementById("pesan_gagal");
        const silang = document.getElementById("silang");

        if (silang) {
            silang.addEventListener("click", () => {
                pesanGagal.style.display = "none";
            });
        }
    </script>
</body>

</html>