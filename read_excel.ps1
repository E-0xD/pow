$excel = New-Object -ComObject Excel.Application
$excel.Visible = $false
$excel.DisplayAlerts = $false
$wb = $excel.Workbooks.Open("c:\Users\Little\Desktop\coding\php\pow\Volunteer Team Application Form (Responses).xlsx")
$ws = $wb.Sheets.Item(1)

Write-Host "Sheet Name: $($ws.Name)"
Write-Host "Used Range Rows: $($ws.UsedRange.Rows.Count)"
Write-Host "Used Range Cols: $($ws.UsedRange.Columns.Count)"
Write-Host "---HEADERS---"
for ($col = 1; $col -le $ws.UsedRange.Columns.Count; $col++) {
    Write-Host "Col ${col}: $($ws.Cells.Item(1, $col).Text)"
}
Write-Host "---SAMPLE DATA (rows 2-6)---"
$maxRow = [Math]::Min(6, $ws.UsedRange.Rows.Count)
for ($row = 2; $row -le $maxRow; $row++) {
    $rowData = ""
    for ($col = 1; $col -le $ws.UsedRange.Columns.Count; $col++) {
        $rowData += $ws.Cells.Item($row, $col).Text + " | "
    }
    Write-Host "Row ${row}: $rowData"
}
$wb.Close($false)
$excel.Quit()
[System.Runtime.Interopservices.Marshal]::ReleaseComObject($excel) | Out-Null
