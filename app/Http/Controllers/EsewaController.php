<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EsewaController extends Controller
{
    public function success(Request $request)
    {
        $url = "https://uat.esewa.com.np/epay/sujanbasnet";
        $data = [
            'amt' => 10, // Replace with the amount you want to send
            'rid' => $request->refId,
            'pid' => $request->pid,
            'scd' => 'epay_payment'
        ];
    
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($curl);
        curl_close($curl);
    
        // No need to process the response here since we're not doing anything with it
    
        return redirect()->route('payment.response')->with('success_message', 'Transaction Completed');
    }
    

    

public function fail(Request $request)
    {
        return redirect()->route('payment.response')->with('error_message', 'You have cancelled your transaction');

    }
}
