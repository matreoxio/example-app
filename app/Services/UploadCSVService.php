<?php 

namespace App\Services;


use Illuminate\Http\Request;
use App\Services\UploadCSVService;
use App\Models\Status;
use App\Models\Shipment;
use League\Csv\Reader;

class UploadCSVService
{
    protected array $requiredHeaders = [
        'shipment_id',
        'origin',
        'destination',
        'weight',
        'status',
    ];

    public function handleUpload($file) 
    {
        $csv = Reader::createFromPath($file->getRealPath(), 'r');
        $csv->setHeaderOffset(0);
        $headers = $csv->getHeader();

        $records = iterator_to_array($csv->getRecords());

        $validRows = [];
        $rowNumber = 1;

        $statusMap = Status::pluck('id', 'name')->mapWithKeys(fn ($id, $name) => [strtolower(trim($name)) => $id]);

        foreach ($records as $row) {
            $rowNumber++;

            // Check if any required field is empty
            foreach ($this->requiredHeaders as $field) {
                if (!isset($row[$field]) || trim($row[$field]) === '') {
                    dd($field, $row);
                    return [
                        'success' => false,
                        'message' => "Missing value in '$field' at row $rowNumber.",
                    ];
                }
            }

            $statusName = strtolower(trim($row['status']));
            $statusId = $statusMap[$statusName] ?? null;

            if (!$statusId) {
                return [
                    'success' => false,
                    'message' => "Invalid status '{$row['status']}' at row $rowNumber.",
                ];
            }

            $validRows[] = [
                'shipment_id' => $row['shipment_id'],
                'origin'      => $row['origin'],
                'destination' => $row['destination'],
                'weight'      => (float)$row['weight'],
                'status_id'      => $statusId,
                'created_at'  => now(),
                'updated_at'  => now(),
            ];
        }

        Shipment::insert($validRows);

        return [
            'success' => true,
            'message' => 'CSV uploaded and records inserted successfully.',
            'inserted_rows' => count($validRows),
        ];
    }
}