<?php
require 'vendor/autoload.php'; // Make sure this path is correct

use PhpOffice\PhpSpreadsheet\IOFactory;

try {
    // Load your Excel file
    $spreadsheet = IOFactory::load('sheet_excel.xlsx');

    // Select the "Contract" sheet
    $sheet = $spreadsheet->getSheetByName('Contract');

    // Create an HTML writer
    $htmlWriter = IOFactory::createWriter($sheet, 'Html');

    // Save the sheet as an HTML file
    $htmlWriter->save('contract.html');

    echo "Contract sheet exported successfully to contract.html";
} catch (\PhpOffice\PhpSpreadsheet\Reader\Exception $e) {
    echo 'Error loading file: ', $e->getMessage();
}
