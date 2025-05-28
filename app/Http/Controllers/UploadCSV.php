<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\UploadCSVService;


class UploadCSV extends Controller
{
    public function __construct(UploadCSVService $csvUploadService)
    {
        $this->csvUploadService = $csvUploadService;
    }

    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt|max:2048',
        ]);
        
        $result = $this->csvUploadService->handleUpload($request->file('file'));

        return response()->json($result);
    }
}
