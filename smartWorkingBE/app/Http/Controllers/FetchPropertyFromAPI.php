<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

use App\Property;
use App\PropertyType;
use Illuminate\Support\Facades\DB;

class FetchPropertyFromAPI extends Controller
{
    public function fetchPropertiesFromApi() {
        
        $end_point = 'api/properties';

        $params = "?api_key=3NLTTNlXsi6rBWl7nYGluOdkl2htFHug";

        $url = 'https://trial.craig.mtcserver15.com/'.$end_point.$params;
         
        $crl = curl_init();
        curl_setopt($crl, CURLOPT_URL, $url);
        curl_setopt($crl, CURLOPT_FRESH_CONNECT, true);
        curl_setopt($crl, CURLOPT_RETURNTRANSFER, true);
         
        $response = curl_exec($crl);
        if(!$response){
           die('Error: "' . curl_error($crl) . '" - Code: ' . curl_errno($crl));
        }
        
        curl_close($crl);

        $response = json_decode($response, true);
        // var_dump($response);

        $resp = $this->savePropertyData($response);

        return $resp;
    }

    public function savePropertyData($data) {

        //saving into property table
        $propertyData = $data['data'];
        $errorCount = 0;
        $recordCount = 0;

        foreach ($propertyData as $key => $value) {

            $newProp = array(
                "property_type_id" => intval($value['property_type_id']),
                "county" => $value['county'],
                "country" => $value['country'],
                "town" => $value['town'],
                "description" => $value['description'],
                "full_details_url" => "/fetchPropertyDetails/".$value['property_type_id'],
                "displayable_name" => $value['address'],
                "image_url" => $value['image_full'],
                "thumbnail_url" => $value['image_thumbnail'],
                "latitude" => $value['latitude'],
                "longitude" => $value['longitude'],
                "no_of_bedrooms" => $value['num_bedrooms'],
                "no_of_bathrooms" => $value['num_bathrooms'],
                "price" => $value['price'],
                "property_type" => $value['property_type']['title'],
                "for_sale_rent" => $value['type'] == "rent" ? "For Rent" : "For Sale",
                "created_at" => date("Y-m-d H:i:s"),
            );

            $newPropType = array(
                "property_id" => $value['property_type']['id'],
                "title" => $value['property_type']['title'],
                "description" => $value['property_type']['description'],
                "created_at" => date("Y-m-d H:i:s"),
            );

            try {
                //save or update data
                $savedPropertyData = Property::updateOrCreate(
                    ['property_type_id' => $newProp['property_type_id']],
                    $newProp
                );

                $savedPropertyTypeData = PropertyType::updateOrCreate(
                    ['property_id' => $newProp['property_type_id']],
                    $newPropType
                );

                $recordCount++;

            } catch (Exception $e) {
                $errorCount++;
                echo $e->getMessage();
            }

        }

        $response = array(
            'statusCode' => 200,
            'message' => ''
        );

        if($errorCount > 0) {
            $response['statusCode'] = 400;
            $response['message'] = "Error occured while saving data";
        } else {
            $response['statusCode'] = 200;
            $response['message'] = "Record saved, count: $recordCount";
        }

        return json_encode($response);

    }

    public function fetchProperties(){

        //fetch data from properties

        $propData = Property::orderBy('property_type_id', 'ASC')->get();

        return response()->json($propData);
    }

    public function fetchPropertyDetails(Request $request){

        $id = $request->id;
        if (is_numeric($id) != 1 && $id == '') {
            return response()->json("Only numbers are allowed!", Response::HTTP_BAD_REQUEST);
        }

        //fetch data from properties

        $data1 = Property::where("property_type_id", $id)->first();
        $data2 = PropertyType::where("property_id", $id)->first();

        $mergedData = $this->mergeData($data1, $data2);

        return response()->json($mergedData);
    }

    public function fetchPropertyTypes() {
        $types = DB::table('property_types')->select('title')->distinct()->get()->toArray();
        $newType = [];

        foreach($types as $t => $p) {
                array_push($newType, $p->title);
        }

        return response()->json($newType);
    }

    public function savePropertyDetails(Request $request) {

        return response()->json($request->all());
    }

    private function mergeData($data1, $data2) {

        $data1 = collect($data1);
        $data2 = collect($data2);

        $merged = $data1->merge($data2);

        return $merged;

    }
}
