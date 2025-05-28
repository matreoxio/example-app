<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shipment;

class RetrieveData extends Controller
{
    public function get()
    {
        $shipments = Shipment::with('status')->get();

        // Map the data to replace `status_id` with `status.name`
        $data = $shipments->map(function ($shipment) {
            return [
                'shipment_id' => $shipment->shipment_id,
                'origin'      => $shipment->origin,
                'destination' => $shipment->destination,
                'weight'      => $shipment->weight,
                'status'      => $shipment->status->name ?? 'Unknown',
                'created_at'  => $shipment->created_at,
                'updated_at'  => $shipment->updated_at,
            ];
        });

        return response()->json($data);
    }
}
