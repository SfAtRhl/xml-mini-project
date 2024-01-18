<?php

function deleteUserById($xmlFile, $idToDelete)
{
    
    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);

        
        $users = $xml->getElementsByTagName("user");

        
        foreach ($users as $user) {
            $userId = $user->getElementsByTagName("id")->item(0)->nodeValue;

            if ($userId == $idToDelete) {
                
                $user->parentNode->removeChild($user);

                
                $xml->save($xmlFile);

                echo "User with ID $idToDelete deleted successfully!";
                return;
            }
        }

        echo "User with ID $idToDelete not found.";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}


if (isset($_GET['id'])) {
    
    $xmlFile = 'user.xml';
    $idToDelete = intval($_GET['id']);

    


    deleteUserById($xmlFile, $idToDelete);
    header('Location: user.xml');
    exit();
} else {
    echo "Error: User ID not provided.";
}
