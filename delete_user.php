<?php

function deleteStudentById($xmlFile, $idToDelete)
{
    
    $xml = new DOMDocument("1.0", "UTF-8");

    if (file_exists($xmlFile) && is_readable($xmlFile)) {
        $xml->load($xmlFile);

        
        $students = $xml->getElementsByTagName("student");

        
        foreach ($students as $student) {
            $studentId = $student->getElementsByTagName("id")->item(0)->nodeValue;

            if ($studentId == $idToDelete) {
                
                $xml->documentElement->removeChild($student);

                
                $xml->save($xmlFile);

                echo "Student with ID $idToDelete deleted successfully!";
                return;
            }
        }

        echo "Student with ID $idToDelete not found.";
    } else {
        echo "Error: XML file not found or not readable.";
    }
}


if (isset($_GET['id'])) {
    
    $xmlFile = 'input.xml';
    $idToDelete = intval($_GET['id']);

    

    
    deleteStudentById($xmlFile, $idToDelete);
    header('Location: input.xml');
    exit();
} else {
    echo "Error: Student ID not provided.";
}
