<?php
include '../../php/db.php';

require '../../vendor/autoload.php'; // Include the library's autoloader


use PhpOffice\PhpSpreadsheet\IOFactory;


session_start();

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '1234567891011121';
$encryption_key = '323232323fjaksdfjalsdf';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if file was uploaded successfully
    if (isset($_FILES["bulkExcelFile"]) && $_FILES["bulkExcelFile"]["error"] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES["bulkExcelFile"]["tmp_name"];

        // Read the Excel file
        $spreadsheet = IOFactory::load($fileTmpPath);
        $sheetData = $spreadsheet->getSheet(0)->toArray();
        unset($sheetData[0]);
        $data = array_values($sheetData);

        // Process the data
        foreach ($data as $key => $row) {
            $voterid = $key + 1;
            $voterName = trim($row[0]);
            $email = trim($row[1]);
            $batch = trim($row[2]);
            $password = openssl_encrypt(trim($row[3]), $ciphering, $encryption_key, $options, $encryption_iv);
            $query = "INSERT INTO voterinfo(voterid, votername, email, batch, password, email_verification_status) VALUES ('$voterid', '$voterName', '$email', '$batch', '$password', 1)";
            try {
                $result = mysqli_query($conn, $query);
                if (!$result) {
                    $_SESSION['bulkVoterAdd'] = 0;
                    header('Location:/Dashboard/voterinfo/Voterlist.php');
                    exit();
                }
            }catch (Exception $exception) {
                echo $exception->getMessage();
                $_SESSION['bulkVoterAdd'] = 0;
                header('Location:/Dashboard/voterinfo/Voterlist.php');
                exit();
            }
        }
        $_SESSION['bulkVoterAdd'] = 1;
        header('Location:/Dashboard/voterinfo/Voterlist.php');
        exit();
    } else {
        $_SESSION['bulkVoterAdd'] = 0;
        header('Location:/Dashboard/voterinfo/Voterlist.php');
        exit();
    }
}