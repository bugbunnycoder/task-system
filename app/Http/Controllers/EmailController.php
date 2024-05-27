<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendEmail()
    {
        

        $to = "besureitsbunny@gmail.com";
        $subject ="Test subject";
        $message = "This is some text to test mail.";

        try {
            Mail::raw($message, function ($mail) use ($to, $subject) {
                $mail->to($to)
                    ->subject($subject);
            });

            echo "mail sent";
        } catch (\Exception $e) {
            // Logtor handle the exception
            echo $e->getMessage();
        }
    }
}
