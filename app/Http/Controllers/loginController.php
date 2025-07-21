<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class loginController extends Controller
{
    function index() 
    {
        return view('sironda.login');

    }

    function login(Request $request)
    {
      //  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      //     $turnstile_response = $_POST["cf-turnstile-response"] ?? '';

      //   if (!$turnstile_response) {
      //     return redirect('simfoni/admin')->withErrors('Gagal Validasi Cloudflare')->withInput();
      //   }

      //     $secret_key = "0x4AAAAAAA7s8WHT-hQC8J0gH75OKLzfsyI"; // Ganti dengan Secret Key dari Cloudflare
      //     $verify_url = "https://challenges.cloudflare.com/turnstile/v0/siteverify";

        // $data = [
        //   "secret" => $secret_key,
        //   "response" => $turnstile_response,
        //   "remoteip" => $_SERVER["REMOTE_ADDR"]
        // ];

        // $options = [
        //     "http" => [
        //     "header"  => "Content-type: application/x-www-form-urlencoded",
        //     "method"  => "POST",
        //     "content" => http_build_query($data)
        //   ]
        // ];

        // $context  = stream_context_create($options);
        // $result = file_get_contents($verify_url, false, $context);
        
        // $response_data = json_decode($result, true);

        // if ($response_data["success"]) {
           echo "Login berhasil!";
            $request->validate([
            'email' => 'required',
            'password' => 'required'
        ],[
            'email.required' => 'Email wajib di isikan',
            'password.required' => 'Password wajib di isikan'
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(Auth::attempt($infologin)){

            if(Auth::user()){
              // ->role == 'admin'){
                return redirect('/');
            } 
            // elseif (Auth::user()->role == 'user'){
            //     return redirect('dash');
            // }

        } else{
            return redirect('login')->withErrors('Username dan Password yang dimasukkan tidak sesuai!')->withInput();
        }
        // }
        //  else {
        //    die("Turnstile validation failed!");
        // }
      // }
        
    }

    function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
