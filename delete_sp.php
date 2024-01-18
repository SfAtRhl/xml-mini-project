<?php

function deleteSpecialtyById($xmlFile, $idToDelete)
{
    
    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);

        
        $specialties = $xml->getElementsByTagName("specialty");

        
        foreach ($specialties as $specialty) {
            $specialtyName = $specialty->getElementsByTagName("name")->item(0)->nodeValue;

            if ($specialtyName == $idToDelete) {
                
                $specialty->parentNode->removeChild($specialty);

                
                $xml->save($xmlFile);

                echo "Specialty with name $idToDelete deleted successfully!";
                return;
            }
        }

        echo "Specialty with name $idToDelete not found.";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}


if (isset($_GET['sp'])) {
    
    $xmlFile = 'user.xml';
    $nameToDelete = $_GET['sp'];

    
    deleteSpecialtyById($xmlFile, $nameToDelete);
    header('Location: user.xml');
    exit();
    
} else {
    echo "Error: Specialty name not provided.";
}
