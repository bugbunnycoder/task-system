<?php
namespace App\Http\Controllers;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;


class ApiController extends Controller
{
    public function generateToken()
    {
        $token = DB::table('personal_access_tokens')->insertGetId([
            'name' => 'Token Name',
            'tokenable_type' => 'default', // Set a default value for tokenable_type
            'tokenable_id' => 0, // Use a dummy value for tokenable_id
            'token' => 'generated-token', // Replace 'generated-token' with your actual token value
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
        // Retrieve the plain text token
        $plainTextToken = DB::table('personal_access_tokens')->where('id', $token)->value('token');

        return $token;
    }
}
