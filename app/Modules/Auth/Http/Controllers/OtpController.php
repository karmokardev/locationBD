<?php

namespace App\Modules\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OtpController extends Controller
{
    public function sendOtpTest(Request $request)
    {
        return response()->json(['message' => 'OTP test route is working']);
    }
}
