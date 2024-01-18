<?php


function appendXmlData($xmlFile, $username, $password, $email, $firstname, $lastname, $dob, $street, $city, $state, $zip, $role)
{

    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);


        $root = $xml->documentElement;
        if (!$root) {
            $root = $xml->createElement('users');
            $xml->appendChild($root);
        }


        $user = $xml->createElement('user');


        $id = $root->getElementsByTagName('user')->length + 1;
        $user->appendChild($xml->createElement('id', $id));
        $user->appendChild($xml->createElement('username', $username));
        $user->appendChild($xml->createElement('password', $password));
        $user->appendChild($xml->createElement('email', $email));
        $user->appendChild($xml->createElement('firstname', $firstname));
        $user->appendChild($xml->createElement('lastname', $lastname));
        $user->appendChild($xml->createElement('dob', $dob));


        $address = $xml->createElement('address');
        $address->appendChild($xml->createElement('street', $street));
        $address->appendChild($xml->createElement('city', $city));
        $address->appendChild($xml->createElement('state', $state));
        $address->appendChild($xml->createElement('zip', $zip));
        $user->appendChild($address);

        $user->appendChild($xml->createElement('role', $role));


        $root->appendChild($user);


        $xml->save($xmlFile);

        echo "User added successfully!";
        echo "<script>window.location.href='';</script>";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $xmlFile = 'user.xml';


    $username = isset($_POST['username']) ? $_POST['username'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $firstname = isset($_POST['first-name']) ? $_POST['first-name'] : '';
    $lastname = isset($_POST['last-name']) ? $_POST['last-name'] : '';
    $dob = isset($_POST['dob']) ? $_POST['dob'] : '';
    $street = isset($_POST['street-address']) ? $_POST['street-address'] : '';
    $city = isset($_POST['city']) ? $_POST['city'] : '';
    $state = isset($_POST['region']) ? $_POST['region'] : '';
    $zip = isset($_POST['postal-code']) ? $_POST['postal-code'] : '';
    $role = isset($_POST['role']) ? $_POST['role'] : '';




    appendXmlData($xmlFile, $username, $password, $email, $firstname, $lastname, $dob, $street, $city, $state, $zip, $role);
    header('Location: user.xml');
    exit();
}


$xml = simplexml_load_file('user.xml');


$roles = [];
foreach ($xml->roles as $user) {
    $role = (string)$user->role;
    if (!in_array($role, $roles)) {
        $roles[] = $role;
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" />
    <title>XML Data Form</title>
</head>

<body>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-2xl xl:p-0 dark:bg-gray-800 dark:border-gray-700 p-4 space-y-2 ">
                <div class="p-4 space-y-4 ">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Add User
                    </h1>
                    <h3 class="text-sm font-meduim leading-tight tracking-tight text-gray-900 md:text-md  dark:text-white">
                        Create A new Account For a User
                    </h3>
                    <form class="space-y-4 md:space-y-6" action="add_user.php" method="post">

                        <!-- Personal Info -->
                        <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>

                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username
                                    <input type="text" name="username" id="username" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                            </div>
                            <div class="sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                                <div class="mt-2">
                                    <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
                                <label for="password" class="block text-sm font-medium leading-6 text-gray-900">Password</label>
                                <div class="mt-2">
                                    <input type="text" name="password" id="password" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="cpassword" class="block text-sm font-medium leading-6 text-gray-900">Confirm Password</label>
                                <div class="mt-2">
                                    <input type="text" name="cpassword" id="cpassword" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                            <div class="col-span-full">
                                <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                                <div class="mt-2">
                                    <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>

                            <div class="sm:col-span-2 sm:col-start-1">
                                <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                                <div class="mt-2">
                                    <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="region" class="block text-sm font-medium leading-6 text-gray-900">State / Province</label>
                                <div class="mt-2">
                                    <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                                <div class="mt-2">
                                    <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                        </div>
                        <!-- Dropdown list for roles -->
                        <div class="mb-4 sm:col-span-2">
                            <label for="role" class="block text-sm font-medium text-gray-900 dark:text-white">Select Role</label>
                            <select id="role" name="role" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                <?php

                                foreach ($roles as $role) {
                                    echo "<option value=\"$role\">$role</option>";
                                }
                                ?>
                            </select>
                        </div>


                        <?php if (isset($error)) : ?>
                            <p style="color: red;"><?php echo $error; ?></p>
                        <?php endif; ?>

                        <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Add</button>



                    </form>


                </div>
            </div>
        </div>
    </section>

</body>

</html>