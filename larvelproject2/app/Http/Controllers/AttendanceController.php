<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{
    public function store(Request $request)
    {
        //dd($request->all());
        $data = $request->validate([
            'person' => 'required|string',
            'timestamp' => 'required|numeric',
            'count' => 'required|numeric',
        ]);
        // dd( $data );
        // exit;
        DB::table('attendances')->insert([
            'person' => $data['person'],
            'person_count' => $data['count'],
            'timestamp' => $data['timestamp'],
            'created_at' => now(),
            'updated_at' => now(),
        ]);
       

        return response()->json(['message' => 'Persons in screen '.$data['count']], 200);
    }
    public function uploadimageforfacerecognition(Request $request){
        $data = json_decode(file_get_contents('php://input'), true);
        $imageData = $data['image'] ?? '';
        $userId = $data['userId'] ?? 'faceimage';

        if (!$imageData || !$userId) {
            http_response_code(400);
            echo "Missing image or user ID.";
            exit;
        }
        exit;
        // Decode and save login image
        $imageData = str_replace('data:image/jpeg;base64,', '', $imageData);
        $imageData = base64_decode($imageData);
        $loginImagePath = "faces/login_{$userId}.jpg";
        file_put_contents($loginImagePath, $imageData);

        // Registered image path
        $registeredImagePath = "faces/faceimage.jpg";

        if (!file_exists($registeredImagePath)) {
            echo "No registered image found for user.";
            exit;
        }
$pythonScript = base_path('python/compare_faces.py');

        // Call Python script
         $command = escapeshellcmd("python3 $pythonScript $registeredImagePath $loginImagePath");
        $output = shell_exec($command);

        echo trim($output);
    }
}
