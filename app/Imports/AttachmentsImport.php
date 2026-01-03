<?php

/*namespace App\Imports;

use App\Models\Attachment;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttachmentsImport implements ToModel, WithHeadingRow
{
    // Override the heading row formatter to preserve keys as-is
    public function headingRow(): int
    {
        return 1;  // assuming first row has headers
    }

    public function headingRowFormatter(string $heading): string
    {
        return $heading;  // preserve original casing and spacing
    }

    public function model(array $row)
    {
        if (!\App\Models\User::where('id', $row['caseid'])->exists()) {
            \Log::warning("Skipping attachment for missing user ID: " . $row['caseid']);
            return null;
        }
        return new Attachment([
            'ID'             => $row['id'],           // exact key from Excel header
            'CaseID'         => $row['caseid']?? null,
            'AttID'          => $row['attid'],
            'AttPath'        => $row['attpath'],
            'Remarks'       => $row['remarks'],
            'Preview'       => $row['preview'],
            'Delete'    => $row['delete'],
        ]);
    }

    private function transformDate($value)
    {
        if (is_numeric($value)) {
            return Date::excelToDateTimeObject($value)->format('Y-m-d');
        }
        return $value;
    }
}*/


namespace App\Imports;

use App\Models\Attachment;
use App\Models\PrimaryData;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AttachmentsImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{
    public function headingRow(): int
    {
        return 1;  // First row contains headers
    }

    public function headingRowFormatter(): string
    {
        return fn($heading) => $heading;  // Keep header case and format as-is
    }

    public function model(array $row)
    {
        // Optional: Skip if user doesn't exist
        if (!PrimaryData::where('id', $row['caseid'])->exists()) {
            Log::warning("Skipping attachment for missing user ID: " . $row['caseid']);
            return null;
        }
        /*if (!isset($row['caseid']) || !User::where('id', $row['caseid'])->exists()) {
        self::$skipped++;
        if (self::$skipped % 1000 === 0) {
            Log::warning("Skipped rows so far: " . self::$skipped);
        }
        return null;
        }

        self::$imported++;
        if (self::$imported % 1000 === 0) {
            Log::info("Imported rows so far: " . self::$imported);
        }*/

        return new Attachment([
            'ID'       => $row['id'],
            'CaseID'   => $row['caseid'] ?? null,
            'AttID'    => $row['attid'],
            'AttPath'  => $row['attpath'],
            'Remarks'  => $row['remarks'],
            'Preview'  => $row['preview'],
            'Delete'   => $row['delete'],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;  // Read 1000 rows per chunk
    }

    public function batchSize(): int
    {
        return 1000;  // Insert 1000 rows per DB query
    }

    private function transformDate($value)
    {
        return is_numeric($value) ? Date::excelToDateTimeObject($value)->format('Y-m-d') : $value;
    }
}
