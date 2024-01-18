<?php

function deleteRoleById($xmlFile, $idToDelete)
{
    
    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);

        
        $roles = $xml->getElementsByTagName("roles");

        
        foreach ($roles as $role) {
            $roleId = $role->getElementsByTagName("role")->item(0)->nodeValue;

            if ($roleId == $idToDelete) {
                
                $xml->documentElement->removeChild($role);

                
                $xml->save($xmlFile);

                echo "Role with ID $idToDelete deleted successfully!";
                return;
            }
        }

        echo "Role with ID $idToDelete not found.";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}


if (isset($_GET['role'])) {
    
    $xmlFile = 'user.xml';
    $idToDelete = $_GET['role'];  

    
    deleteRoleById($xmlFile, $idToDelete);
    header('Location: user.xml');
    exit();
} else {
    echo "Error: Role ID not provided.";
}
