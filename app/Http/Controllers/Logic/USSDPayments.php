<?php

namespace App\Http\Controllers\Logic;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class USSDPayments extends Controller
{
    public $sessionId;  
    public $serviceCode;
    public $phoneNumber;
    public $text;
    public $spaceid;
    public $amount;
    public $payerPhoneNumber;      
    public function handleRequest(Request $request)
    {
        
        $this->sessionId   = $request->sessionId;
        $this->serviceCode = $request->serviceCode;
        $this->phoneNumber = $request->phoneNumber;
        $this->text        = $request->text;

        if($this->text == "")
        {
            $response = "CON Welcome to The Landlod.\n";
            $response .= "1. Pay Rent.";
            return $response;
        }
        else 
        {
            //echo "CON Enter Space Code.";
            $textArray = explode("*", $this->text);
            switch($textArray[0]){
                case 1: 
                    $this->payRentSteps($textArray);
                break;
                default:
                    echo "END Invalid choice. Please try again";
            }
        }
    }

    public function payRentSteps($textArray){
        
          $level = count($textArray);
         if($level == 1){
              echo "CON Please Enter Space Code:";
         } else if($level == 2){
              echo "CON Please Enter Amount:";
         }else if($level == 3){
              echo "CON Please Enter PIN:";
         }else if($level == 4){
            //   $this->spaceid = $textArray[0];
            //   $this->amount = $textArray[1];
              
                  echo "END You have paid " . $textArray[0];
              
         }
      }
}
