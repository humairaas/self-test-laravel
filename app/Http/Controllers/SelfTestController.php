<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class SelfTestController extends Controller
{
    function postData(Request $request){
        try{
            $testData = $request->input("testData");
            $testData_obj = json_decode($testData);
            
            $type = $testData_obj->type;
            $score = $testData_obj->score;
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $date = date("Y-m-d h:i:s");
            
            $request_app = $request->input("request_app");
            $req_app_obj = json_decode($request_app);

            $mentari =  !empty($req_app_obj->mentari) ? $req_app_obj->mentari: 0;
            $fullName =  $req_app_obj->fullName;
            $email =  $req_app_obj->email;
            $nric =  !empty($req_app_obj->nric) ? $req_app_obj->nric: 0;
            $telNum =  $req_app_obj->telNum;
            $address1 =  !empty($req_app_obj->address1) ? $req_app_obj->address1: '';
            $address2 =  !empty($req_app_obj->address2) ? $req_app_obj->address2: '';
            $postCode =  !empty($req_app_obj->postCode) ? $req_app_obj->postCode: 0;
            $city =  !empty($req_app_obj->city) ? $req_app_obj->city: '';
            $state =  !empty($req_app_obj->state) ? $req_app_obj->state: '';

            $data = array('MENTARI_ID' => $mentari,'FULL_NAME' => $fullName, 'EMAIL' => $email, 'NRIC' => $nric, 'TEL_NUM' => $telNum, 'ADD_L1' => $address1, 'ADD_L2' => $address2, 'POST_CODE' => $postCode, 'CITY' => $city, 'STATE' => $state, 'TYPE' => $type,'SCORE' => $score, 'DATE' => $date);
            
            $query = DB::table('req_app')->insert($data);
  
            http_response_code(200);
            return response([
                'message' => 'Data successfully Created.'
            ]);
        
        }catch (RequestException $r){
            http_response_code(400);
            return response([
                'message' => 'Failed to Create data.'
            ]);
        }
    }
    function postTestData(Request $request){
        try{
            date_default_timezone_set("Asia/Kuala_Lumpur");
            $date = date("Y-m-d h:i:s");
            $type = $request->input('type');
            $score = $request->input('score');

            $data = array('TYPE' => $type,'SCORE' => $score, 'TEST_DATE' => $date);
            $query = DB::table('self_test')->insert($data);
  
            http_response_code(200);
            return response([
                'message' => 'Data successfully Created.'
            ]);
        
        }catch (RequestException $r){
            http_response_code(400);
            return response([
                'message' => 'Failed to Create data.'
            ]);
        }
    }

    function getData(Request $request){
        return [$request->input('request_app')];
        try{

        }catch (RequestException $r){

        }

    }

    function deleteData(Request $request){
        try{

        }catch (RequestException $r){

        }

    }
}
