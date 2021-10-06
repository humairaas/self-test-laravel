<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Exception\RequestException;

class SelfTestController extends Controller
{
    function postData(Request $request){
        try{
            $id = $request->input("result_id");

            $request_app = $request->input("request_app");
            $req_app_obj = json_decode($request_app);

            $mentari_id =  !empty($req_app_obj->mentari);
            $nric_type = NULL;
            $nric_number =  !empty($req_app_obj->nric);
            $nric_number_string = str_replace('-', '', $nric_number);
            $name =  $req_app_obj->fullName;
            $telNo =  $req_app_obj->telNum;
            $telNo_number = str_replace('', '', $telNo);
            $address1 =  !empty($req_app_obj->address1) ? $req_app_obj->address1: NULL;
            $address2 =  !empty($req_app_obj->address2) ? $req_app_obj->address2: NULL;
            $state =  !empty($req_app_obj->state) ? $req_app_obj->state: NULL;
            $city =  !empty($req_app_obj->city) ? $req_app_obj->city: NULL;
            $postcode =  !empty($req_app_obj->postCode) ? $req_app_obj->postCode: NULL;
            $email =  $req_app_obj->email;

            $data = array('psychometric_result_id' => $id, 'mentari_id' =>$mentari_id,'nric_type' => $nric_type, 'nric_number' => $nric_number_string, 'name' => $name, 'telno' => $telNo_number, 'address1' => $address1, 'address2' => $address2, 'state' => $state, 'city' => $city, 'postcode' => $postcode, 'email' => $email);

            $query = DB::table('appointment_selftest')->insert($data);

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
            $type = $request->input('type');
            $score = $request->input('score');

            $data = array('psychometric_id' => $type,'psychometric_score' =>$score);
            $query = DB::table('psychometric_result')-> insertGetId($data);

            http_response_code(200);
            return response([
                'message' => 'Data successfully Created.',
                'id' => $query
            ]);

        }catch (RequestException $r){
            http_response_code(400);
            return response([
                'message' => 'Failed to Create data.'
            ]);
        }
    }

    function getTestRange(Request $request){
        try{
            $type = $request->input('type');
            $query = DB::table('psychometric_range')
                        ->select('range_min_value','range_max_value','range_label', 'range_description')
                        ->where('psychometric_id', $type)
                        ->get();

            http_response_code(200);
            return response([
                'message' => 'Data inserted successfully.',
                'data' => $query
            ]);


        }catch (RequestException $r){
            http_response_code(400);
            return response([
                'message' => 'Failed to Create data.'
            ]);
        }
    }

    function getState(Request $request){
        try{
            $country_id = $request->input('country_id');
            $query = DB::table('set_state')
                        ->select('state_id AS id','desc AS name')
                        ->where('country_id',$country_id)
                        ->get();

            http_response_code(200);
            return response([
                'message' => 'Data successfully Created.',
                'data' => $query
            ]);


        }catch (RequestException $r){
            http_response_code(400);
            return response([
                'message' => 'Failed to Create data.'
            ]);
        }
    }

    function getCity(Request $request){
        try{
            $state_id = $request->input('state_id');
            $query = DB::table('set_city')
                        ->select('city_id AS id','desc AS name')
                        ->where('state_id',$state_id)
                        ->get();

            http_response_code(200);
            return response([
                'message' => 'Data successfully Created.',
                'data' => $query
            ]);


        }catch (RequestException $r){
            http_response_code(400);
            return response([
                'message' => 'Failed to Create data.'
            ]);
        }
    }

    function getPostcode(Request $request){
        try{
            $city_id = $request->input('city_id');
            $query = DB::table('set_postcode')
                        ->select('postcode_id AS id','desc AS name')
                        ->where('city_id',$city_id)
                        ->get();

            http_response_code(200);
            return response([
                'message' => 'Data successfully Created.',
                'data' => $query
            ]);


        }catch (RequestException $r){
            http_response_code(400);
            return response([
                'message' => 'Failed to Create data.'
            ]);
        }
    }

    function deleteData(Request $request){
        try{

        }catch (RequestException $r){

        }

    }
}
