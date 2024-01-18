<?php
session_start();


if (isset($_SESSION['username'])) {
    header("Location: profile_user.php");
    exit();
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $xml = simplexml_load_file('user.xml');


    foreach ($xml->users->user as $user) {
        $username = (string)$user->username;
        $password = (string)$user->password;
        $role = (string) $user->role;
        $userId = (string) $user->id;


        if ($_POST['username'] === $username && $_POST['password'] === $password && $role == 'user') {





            echo '<script type="text/javascript">';
            echo 'window.location.href = "profile.php?id=' . $userId . '";';
            echo '</script>';
            exit();
        }
    }

    if (isset($_POST['remember'])) {

        setcookie('remember_username', $_POST['username'], time() + (30 * 24 * 60 * 60));
        setcookie('remember_password', $_POST['password'], time() + (30 * 24 * 60 * 60));
    }

    $error = "Nom d'utilisateur ou mot de passe incorrect.";

    if (isset($_COOKIE['remember_username']) && isset($_COOKIE['remember_password'])) {
        $rememberedUsername = $_COOKIE['remember_username'];
        $rememberedPassword = $_COOKIE['remember_password'];
    } else {
        $rememberedUsername = '';
        $rememberedPassword = '';
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />

</head>

<body>

    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <form class="space-y-4 md:space-y-6" method="post">
                        <div>
                            <label for="username" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="text" id="username" name="username" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required value="<?php echo $rememberedUsername; ?>">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" name="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required value="<?php echo htmlspecialchars($rememberedPassword); ?>">
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="remember" name="remember" aria-describedby="remember" type="checkbox" class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800">
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="remember" class="text-gray-500 dark:text-gray-300">Remember me</label>
                                </div>
                            </div>
                        </div>
                        <?php if (isset($error)) : ?>
                            <p style="color: red;"><?php echo $error; ?></p>
                        <?php endif; ?>

                        <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Sign in</button>
                        <div class="ml-3 text-sm w-full text-center">
                            <label class="text-gray-500 dark:text-gray-300 px-4">You don't have an account yet :) <span class="font-bold hover:underline px-2"><a href="signup.php">Sign Up</a></span></label>
                        </div>
                    </form>
                </div>

            </div>
            <div class="w-full flex flex-row justify-end p-4">
                <button class="w-1/4  text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800"><a href="login_admin.php">Sign in as Admin</a></button>
            </div>
        </div>

    </section>

</body>

</html>