<?php



function updateXmlData($xmlFile, $roleToUpdate, $updatedPermissions)
{



    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);


        $roles = $xml->getElementsByTagName('roles');

        foreach ($roles as $existingRoleElement) {
            $role = $existingRoleElement->getElementsByTagName('role')->item(0)->nodeValue;

            if ($role == $roleToUpdate) {

                $permissions = $existingRoleElement->getElementsByTagName('permissions');
                if ($permissions->length > 0) {
                    $existingRoleElement->removeChild($permissions->item(0));
                }


                $permissionsElement = $xml->createElement('permissions');
                foreach ($updatedPermissions as $updatedPermission) {
                    $permissionElement = $xml->createElement('permission', $updatedPermission);
                    $permissionsElement->appendChild($permissionElement);
                }
                $existingRoleElement->appendChild($permissionsElement);


                $xml->save($xmlFile);

                echo "Role updated successfully!";
                echo "<script>window.location.href='';</script>";
                return;
            }
        }
    }
}



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $xmlFile = 'user.xml';

    $roleToUpdate = isset($_POST['role']) ? $_POST['role'] : '';
    $updatedPermissions = isset($_POST['permissions']) ? $_POST['permissions'] : [];
    echo $_POST['role'];
    echo $updatedPermissions[4];

    updateXmlData($xmlFile, $roleToUpdate, $updatedPermissions);
    header('Location: user.xml');
    exit();
} else {
}

$xml = simplexml_load_file('user.xml');


$permissions = [];

foreach ($xml->roles as $roleElement) {
    $role = (string)$roleElement->role;

    if ($role == "admin") {
        foreach ($roleElement->permissions->permission as $permission) {
            $permissionValue = (string)$permission;
            $permissions[] = $permissionValue;
        }
    }
}
$permissionsSelected = [];

foreach ($xml->roles as $roleElement) {
    $role = (string)$roleElement->role;

    if ($role == $_GET['role']) {
        foreach ($roleElement->permissions->permission as $permission) {
            $permissionValue = (string)$permission;
            $permissionsSelected[] = $permissionValue;
        }
    }
}

$role = isset($_GET['role']) ? $_GET['role'] : '';

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
    <section class="bg-gray-50 dark:bg-gray-900 h-full ">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto">
            <form action="edit_role.php" method="post" class="w-96  flex flex-col space-y-2 container mx-auto mt-10 align-center ">
                <div class="mb-4 sm:col-span-2">
                    <label for="role" class="block text-sm font-medium text-gray-900 dark:text-white">Role Name</label>
                    <input class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" disabled value="<?php echo $role ?>">
                    <input id="role" name="role" type="hidden" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" value="<?php echo $role ?>">

                    </input>
                </div>
                <div class="mb-4 sm:col-span-2">
                    <label for="roles" class="block text-sm font-medium text-gray-900 dark:text-white">Select from List of Permissions</label>

                    <select id="permissions" name="permissions[]" class="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-96 text-center space-y-1" required="" multiple>
                        <?php

                        foreach ($permissions as $permission) {
                            $isSelected = in_array($permission, $permissionsSelected) ? 'selected' : '';
                            echo "<option class='font-medium py-2 rounded-full' value=\"$permission\" $isSelected>$permission</option>";
                        }
                        ?>
                    </select>
                </div>
                <button type="submit" class="bg-transparent hover:bg-blue-500 text-blue-700 font-semibold hover:text-white py-2 px-4 border border-blue-500 hover:border-transparent rounded">Update Role</button>
            </form>
        </div>
    </section>
</body>

</html>