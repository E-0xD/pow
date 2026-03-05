<?php
$file = __DIR__ . '/Volunteer Team Application Form (Responses).xlsx';
$zip = new ZipArchive();
$zip->open($file);

$sharedStrings = [];
$ssXml = $zip->getFromName('xl/sharedStrings.xml');
if ($ssXml) {
    $ss = new SimpleXMLElement($ssXml);
    foreach ($ss->si as $si) {
        $text = '';
        if (isset($si->t)) $text = (string) $si->t;
        elseif (isset($si->r)) { foreach ($si->r as $r) $text .= (string) $r->t; }
        $sharedStrings[] = $text;
    }
}

$sheetXml = $zip->getFromName('xl/worksheets/sheet1.xml');
$sheet = new SimpleXMLElement($sheetXml);

$allRows = [];
foreach ($sheet->sheetData->row as $row) {
    $rowNum = (int) $row['r'];
    $cells = [];
    foreach ($row->c as $cell) {
        $ref = (string) $cell['r'];
        $type = (string) $cell['t'];
        $value = (string) $cell->v;
        if ($type === 's') $value = $sharedStrings[(int) $value] ?? $value;
        $col = preg_replace('/[0-9]/', '', $ref);
        $cells[$col] = $value;
    }
    $allRows[$rowNum] = $cells;
}

echo "TOTAL ROWS: " . count($allRows) . "\n\n";

// Print headers
echo "=== COLUMNS ===\n";
if (isset($allRows[1])) {
    foreach ($allRows[1] as $col => $header) {
        echo "  $col => " . substr($header, 0, 80) . "\n";
    }
}

// Print first 3 data rows
for ($i = 2; $i <= min(4, count($allRows)); $i++) {
    echo "\n=== ROW $i ===\n";
    if (isset($allRows[$i])) {
        foreach ($allRows[$i] as $col => $val) {
            $header = $allRows[1][$col] ?? $col;
            $shortHeader = substr($header, 0, 30);
            echo "  $col ($shortHeader): " . substr($val, 0, 60) . "\n";
        }
    }
}

$zip->close();
