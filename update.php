<?php


function updateXmlData($xmlFile, $id, $status)
{

    $xml = new DOMDocument("1.0", "UTF-8");
    $xml->preserveWhiteSpace = false;
    $xml->formatOutput = true;

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);


        $students = $xml->getElementsByTagName("user");


        foreach ($students as $user) {
            $userId = $user->getElementsByTagName("id")->item(0)->nodeValue;

            if ($userId == $id) {

                $user->getElementsByTagName("status")->item(0)->nodeValue = $status;


                $xml->save($xmlFile);

                echo "Status updated successfully!";
                return;
            }
        }
        echo "User not found.";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlFile = 'user.xml';

    $id = isset($_POST['id']) ? $_POST['id'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';

    updateXmlData($xmlFile, $id, $status);
    header('Location: user.xml');
    exit();
} else {
}



$xml = simplexml_load_file('user.xml');


$id = isset($_GET['id']) ? $_GET['id'] : '';


$targetUser = null;
foreach ($xml->users->user as $user) {
    $user_id = (string)$user->id;

    if ($user_id == $id) {
        $targetUser = $user;
        break;
    }
}


if ($targetUser !== null) {

    $username = (string)$targetUser->username;
    $password = (string)$targetUser->password;
    $email = (string)$targetUser->email;
    $firstname = (string)$targetUser->firstname;
    $lastname = (string)$targetUser->lastname;
    $dob = (string)$targetUser->dob;
    $street = (string)$targetUser->address->street;
    $city = (string)$targetUser->address->city;
    $state = (string)$targetUser->address->state;
    $zip = (string)$targetUser->address->zip;
    $role = (string)$targetUser->role;
    $bac = (string)$targetUser->bac;
    $status1 = (string)$targetUser->status;
    $speicality = (string)$targetUser->specialty;
    $diplome = (string)$targetUser->diplome;
} else {
}

$xml = simplexml_load_file('user.xml');

$statusies = [];

foreach ($xml->statusies->status as $status) {

    $statusValue = (string)$status;

    if (!in_array($statusValue, $statusies)) {
        $statusies[] = $statusValue;
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

<body class="">
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-2xl xl:p-0 dark:bg-gray-800 dark:border-gray-700 p-4 space-y-2 ">
                <div class="p-4 space-y-4 ">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Update User profile
                    </h1>

                    <form class="space-y-4 md:space-y-6" action="update.php" method="post">
                        <input type="hidden" id="id" name="id" value="<?= isset($_GET['id']) ? $_GET['id'] : '' ?>">


                        <!-- Personal Info -->
                        <div class="flex flex-row justify-between pr-4">
                            <h2 class="text-base font-semibold leading-7 text-gray-900">Personal Information</h2>
                            <h3 class="text-base font-semibold leading-7 text-gray-900 col-span-6 bg-transparent hover:bg-green-500 text-green-500 font-semibold hover:text-white py-1 px-6 border border-green-500 hover:border-transparent rounded-full "><?php echo $status1; ?> </h3>
                        </div>


                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                            <div class="sm:col-span-4">
                                <label for="username" class="block text-sm font-medium leading-6 text-gray-900">Username
                                    <input type="text" name="username" id="username" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4 " disabled value="<?php echo $username; ?> ">
                            </div>
                            <div class="sm:col-span-2">
                                <label for="region" class="block text-sm font-medium leading-6 text-gray-900"> Dossier Status</label>

                                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    <?php

                                    foreach ($statusies as $status) {
                                        echo "<option value=\"$status\" >$status</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class=" sm:col-span-3">
                                <label for="first-name" class="block text-sm font-medium leading-6 text-gray-900">First name</label>
                                <div class="mt-2">
                                    <input type="text" name="first-name" id="first-name" autocomplete="given-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $firstname; ?> ">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="last-name" class="block text-sm font-medium leading-6 text-gray-900">Last name</label>
                                <div class="mt-2">
                                    <input type="text" name="last-name" id="last-name" autocomplete="family-name" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $lastname; ?> ">
                                </div>
                            </div>

                            <div class="sm:col-span-4">
                                <label for="email" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input id="email" name="email" type="email" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $email; ?> ">
                                </div>
                            </div>

                            <div class="col-span-full">
                                <label for="street-address" class="block text-sm font-medium leading-6 text-gray-900">Street address</label>
                                <div class="mt-2">
                                    <input type="text" name="street-address" id="street-address" autocomplete="street-address" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $street; ?> ">
                                </div>
                            </div>

                            <div class="sm:col-span-2 col-start-1">
                                <label for="city" class="block text-sm font-medium leading-6 text-gray-900">City</label>
                                <div class="mt-2">
                                    <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $city; ?> ">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="region" class="block text-sm font-medium leading-6 text-gray-900">State / Province</label>
                                <div class="mt-2">
                                    <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $state; ?> ">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="postal-code" class="block text-sm font-medium leading-6 text-gray-900">ZIP / Postal code</label>
                                <div class="mt-2">
                                    <input type="text" name="postal-code" id="postal-code" autocomplete="postal-code" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $zip; ?> ">
                                </div>
                            </div>

                            <h2 class="text-base font-semibold leading-7 text-gray-900 col-span-6">Formation Professionel</h2>

                            <div class="sm:col-span-3">
                                <label for="city" class="block text-sm font-medium leading-6 text-gray-900">Bac</label>
                                <div class="mt-2">
                                    <input type="text" name="city" id="city" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $bac; ?> ">
                                </div>
                            </div>

                            <div class="sm:col-span-3">
                                <label for="region" class="block text-sm font-medium leading-6 text-gray-900"> speciality</label>
                                <div class="mt-2">
                                    <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $speicality; ?> ">
                                </div>
                            </div>
                            <div class="sm:col-span-4">
                                <label for="region" class="block text-sm font-medium leading-6 text-gray-900"> Diploma</label>
                                <div class="mt-2">
                                    <input type="text" name="region" id="region" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4" disabled value="<?php echo $diplome; ?> ">
                                </div>
                            </div>
                            <!-- <h3 class="text-base font-semibold leading-7 text-gray-900 col-span-6">Suivi E</h3> -->


                        </div>

                        <?php if (isset($error)) : ?>
                            <p style="color: red;"><?php echo $error; ?></p>
                        <?php endif; ?>

                        <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800 disabled:opacity-50 disabled:cursor-not-allowed">Update User Profile</button>



                    </form>


                </div>
            </div>
        </div>
    </section>