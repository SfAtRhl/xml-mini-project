<?php


function appendXmlData(
    $xmlFile,
    $username,
    $password,
    $email,
    $firstname,
    $lastname,
    $street,
    $city,
    $state,
    $zip,
    $dob,
    $bac,
    $specialty,
    $diplome,
    $noteS1,
    $noteS2,
    $noteS3,
    $noteS4,
    $classement_1,
    $classement_2,
    $license
) {

    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);


        $root = $xml->documentElement;


        $usersElement = $root->getElementsByTagName('users')->item(0);
        if (!$usersElement) {
            $usersElement = $xml->createElement('users');
            $root->appendChild($usersElement);
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

        $user->appendChild($xml->createElement('role', "user"));
        $user->appendChild($xml->createElement('bac', $bac));
        $user->appendChild($xml->createElement('status', "pending"));
        $user->appendChild($xml->createElement('specialty', $specialty));
        $user->appendChild($xml->createElement('diplome', $diplome));
        $user->appendChild($xml->createElement('noteS1', $noteS1));
        $user->appendChild($xml->createElement('noteS2', $noteS2));
        $user->appendChild($xml->createElement('noteS3', $noteS3));
        $user->appendChild($xml->createElement('noteS4', $noteS4));
        $user->appendChild($xml->createElement('classement_1', $classement_1));
        $user->appendChild($xml->createElement('classement_2', $classement_2));



        $user->appendChild($xml->createElement('license', $license));



        $usersElement->appendChild($user);


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
    $bac = isset($_POST['bac']) ? $_POST['bac'] : '';
    $status = isset($_POST['status']) ? $_POST['status'] : '';
    $specialty = isset($_POST['specialty']) ? $_POST['specialty'] : '';
    $diplome = isset($_POST['diploma']) ? $_POST['diploma'] : '';
    $dob = isset($_POST['date']) ? $_POST['date'] : '';
    $noteS1 = isset($_POST['noteS1']) ? $_POST['noteS1'] : '';
    $noteS2 = isset($_POST['noteS2']) ? $_POST['noteS2'] : '';
    $noteS3 = isset($_POST['noteS3']) ? $_POST['noteS3'] : '';
    $noteS4 = isset($_POST['noteS4']) ? $_POST['noteS4'] : '';
    $classement_1 = isset($_POST['classement_1']) ? $_POST['classement_1'] : '';
    $classement_2 = isset($_POST['classement_2']) ? $_POST['classement_2'] : '';
    $license = isset($_POST['license']) ? $_POST['license'] : '';












    appendXmlData(
        $xmlFile,
        $username,
        $password,
        $email,
        $firstname,
        $lastname,
        $street,
        $city,
        $state,
        $zip,
        $dob,
        $bac,
        $specialty,
        $diplome,
        $noteS1,
        $noteS2,
        $noteS3,
        $noteS4,
        $classement_1,
        $classement_2,
        $license
    );

    header('Location: user.xml');
    exit();
}
$xml = simplexml_load_file('user.xml');

$bacs = [];
foreach ($xml->bacs->bac as $bac) {
    $bacValue = (string)$bac;


    $bacs[] = $bacValue;
}

$specialtiesWithDiplomas = [];
$specialtiesWithLicenses = [];

foreach ($xml->specialties->specialty as $specialty) {
    $specialtyName = (string)$specialty->name;
    $diplomas = [];
    $licenses = [];

    foreach ($specialty->diploma as $diploma) {
        $diplomas[] = (string)$diploma;
    }

    foreach ($specialty->License as $license) {
        $licenses[] = (string)$license;
    }

    $specialtiesWithDiplomas[$specialtyName] = $diplomas;
    $specialtiesWithLicenses[$specialtyName] = $licenses;
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

<body class="h-auto w-full">


    <section class="bg-gray-50 dark:bg-gray-900 py-4">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto  lg:py-0">

            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-2xl xl:p-0 dark:bg-gray-800 dark:border-gray-700 p-4 space-y-2 ">
                <div class="p-4 space-y-4 ">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign Up
                    </h1>
                    <h3 class="text-sm font-meduim leading-tight tracking-tight text-gray-900 md:text-md  dark:text-white flex flex-row justify-between">
                        <span> Create an Account</span>

                        <div class="flex flex-row ">
                            <span class="text-xs font-bold  bg-red-200 px-4 py-2 rounded-full mx-2">All Field are Required </span>
                            <span class="text-xs font-bold  bg-green-200 px-4 py-2 rounded-full"> U have to Fill All The Fields</span>

                        </div>
                    </h3>

                    <form class="space-y-4 md:space-y-6" method="post">

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
                            <div class="sm:col-span-3">
                                <label for="Birth Date" class="block text-sm font-medium leading-6 text-gray-900">Email address</label>
                                <div class="mt-2">
                                    <input id="date" name="date" type="date" autocomplete="email" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                            <div class="sm:col-span-3">
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

                            <!-- Dropdown list for bacs -->
                            <div class="mb-4 sm:col-span-3">
                                <label for="bac" class="block text-sm font-medium text-gray-900 dark:text-white">Select Bac</label>
                                <select id="bac" name="bac" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    <?php

                                    foreach ($bacs as $bac) {
                                        echo "<option value=\"$bac\">$bac</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <!-- First dropdown for selecting specialty -->
                            <div class="mb-4 sm:col-span-3">
                                <label for="specialty" class="block text-sm font-medium text-gray-900 dark:text-white">Select Specialty</label>
                                <select id="specialty" name="specialty" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    <?php

                                    foreach ($specialtiesWithDiplomas as $specialty => $diplomas) {
                                        echo "<option value=\"$specialty\">$specialty</option>";
                                    }
                                    ?>
                                </select>
                            </div>



                            <!-- Second dropdown for selecting diploma based on specialty -->
                            <div class="mb-4 sm:col-span-4">
                                <label for="diploma" class="block text-sm font-medium text-gray-900 dark:text-white">Select Diploma</label>
                                <select id="diploma" name="diploma" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    <!-- Options will be dynamically populated using JavaScript -->
                                </select>
                            </div>

                            <div class="sm:col-span-2 sm:col-start-1">
                                <label for="noteS1" class="block text-sm font-medium leading-6 text-gray-900">Note S1</label>
                                <div class="mt-2">
                                    <input type="text" name="noteS1" id="noteS1" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="noteS2" class="block text-sm font-medium leading-6 text-gray-900">Note S2</label>
                                <div class="mt-2">
                                    <input type="text" name="noteS2" id="noteS2" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="classement_1" class="block text-sm font-medium leading-6 text-gray-900">Classement</label>
                                <div class="mt-2">
                                    <input type="text" name="classement_1" id="classement_1" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                            <div class="sm:col-span-2 sm:col-start-1">
                                <label for="noteS3" class="block text-sm font-medium leading-6 text-gray-900">Note S3</label>
                                <div class="mt-2">
                                    <input type="text" name="noteS3" id="noteS3" autocomplete="address-level2" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label for="noteS4" class="block text-sm font-medium leading-6 text-gray-900">Note S4</label>
                                <div class="mt-2">
                                    <input type="text" name="noteS4" id="noteS4" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                            <div class="sm:col-span-2">
                                <label for="classement_2" class="block text-sm font-medium leading-6 text-gray-900">Classement</label>
                                <div class="mt-2">
                                    <input type="text" name="classement_2" id="classement_2" autocomplete="address-level1" class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 px-4">
                                </div>
                            </div>
                            <!-- Third dropdown for selecting license based on specialty -->
                            <div class="mb-4 sm:col-span-4">
                                <h2 class="text-base font-semibold leading-7 text-gray-900 pb-4">Formation Parcours</h2>


                                <label for="license" class="block text-sm font-medium text-gray-900 dark:text-white">Select License</label>
                                <select id="license" name="license" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                                    <!-- Options will be dynamically populated using JavaScript -->
                                </select>
                            </div>

                            <!-- JavaScript to dynamically update the second and third dropdown options based on the selected specialty -->
                            <script>
                                document.getElementById('specialty').addEventListener('change', function() {
                                    var selectedSpecialty = this.value;
                                    var diplomas = <?php echo json_encode($specialtiesWithDiplomas); ?>;
                                    var licenses = <?php echo json_encode($specialtiesWithLicenses); ?>;
                                    var diplomaDropdown = document.getElementById('diploma');
                                    var licenseDropdown = document.getElementById('license');


                                    diplomaDropdown.innerHTML = '';
                                    licenseDropdown.innerHTML = '';


                                    if (diplomas[selectedSpecialty]) {
                                        diplomas[selectedSpecialty].forEach(function(diploma) {
                                            var option = document.createElement('option');
                                            option.value = diploma;
                                            option.text = diploma;
                                            diplomaDropdown.appendChild(option);
                                        });
                                    }


                                    if (licenses[selectedSpecialty]) {
                                        licenses[selectedSpecialty].forEach(function(license) {
                                            var option = document.createElement('option');
                                            option.value = license;
                                            option.text = license;
                                            licenseDropdown.appendChild(option);
                                        });
                                    }
                                });
                            </script>



                            <!-- Uplaod files  -->
                            <div class="col-span-6 space-y-2 flex flex-col  justify-between">
                                <h2 class="text-base font-semibold leading-7 text-gray-900 pb-4">Upload Files</h2>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="font-[sans-serif] max-w-xl ">
                                        <label class="text-sm text-black mb-2 block">CNI "Upload file"</label>
                                        <input type="file" class="w-full text-black text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-2.5 file:px-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-black rounded" />
                                        <p class="text-xs text-gray-400 mt-2" required>PNG, JPG are Allowed.</p>
                                    </div>
                                    <div class="font-[sans-serif] max-w-xl ">
                                        <label class="text-sm text-black mb-2 block">BAC "Upload file"</label>
                                        <input type="file" class="w-full text-black text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-2.5 file:px-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-black rounded" />
                                        <p class="text-xs text-gray-400 mt-2" required>PNG, JPG are Allowed.</p>
                                    </div>
                                    <div class="font-[sans-serif] max-w-xl ">
                                        <label class="text-sm text-black mb-2 block">Relver des Notes "Upload file"</label>
                                        <input type="file" class="w-full text-black text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-2.5 file:px-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-black rounded" />
                                        <p class="text-xs text-gray-400 mt-2" required>PNG, JPG are Allowed.</p>
                                    </div>
                                    <div class="font-[sans-serif] max-w-xl ">
                                        <label class="text-sm text-black mb-2 block">Diplome "Upload file"</label>
                                        <input type="file" class="w-full text-black text-sm bg-white border file:cursor-pointer cursor-pointer file:border-0 file:py-2.5 file:px-4 file:bg-gray-100 file:hover:bg-gray-200 file:text-black rounded" />
                                        <p class="text-xs text-gray-400 mt-2" required>PNG, JPG are Allowed.</p>
                                    </div>
                                </div>
                            </div>
                        </div>



                        <?php if (isset($error)) : ?>
                            <p style="color: red;"><?php echo $error; ?></p>
                        <?php endif; ?>

                        <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-500 dark:hover:bg-blue-600 dark:focus:ring-blue-800">Sign in</button>

                        <div class="ml-3 text-sm w-full text-center">
                            <label class="text-gray-500 dark:text-gray-300">Already have an Account ?<span class="font-bold hover:underline px-2"><a href="index.php">Sign in</a></span></label>
                        </div>


                    </form>


                </div>
            </div>
        </div>
    </section>

</body>

</html>