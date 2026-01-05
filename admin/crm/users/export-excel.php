<?php
require '../../../vendor/autoload.php';
require_once "../../conn.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$headers = [
    "No.",
    "First Name",
    "Last Name",
    "Gender",
    "DOB",
    "Phone",
    "Email",
    "Address",
    "Join Date"
];

$sheet->fromArray($headers, null, 'A1');

$headerStyle = [
    'font' => [
        'bold' => true
    ],
    'alignment' => [
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
    ],
    'fill' => [
    'fillType' => Fill::FILL_SOLID,
    'color' => ['rgb' => '00FF00']
    ],

    'borders' => [
        'allBorders' => [
            'borderStyle' => Border::BORDER_THIN
        ]
    ]
];

$sheet->getStyle('A1:I1')->applyFromArray($headerStyle);

$sql = mysqli_query($conn, "SELECT * FROM members ORDER BY id ASC");
$data = [];
$no = 1;

while ($row = mysqli_fetch_assoc($sql)) {
    $data[] = [
        $no++,
        $row['first_name'],
        $row['last_name'],
        $row['gender'],
        $row['dob'],
        $row['phone'],
        $row['email'],
        $row['address'],
        $row['join_date']
    ];
}

$sheet->fromArray($data, null, 'A2');

foreach (range('A', 'I') as $col) {
    $sheet->getColumnDimension($col)->setAutoSize(true);
}

// Download file
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="members_export_' . date('Ymd_His') . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');

mysqli_close($conn);
exit();
?>
