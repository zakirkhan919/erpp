<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function successResponse($result, $message, $responseCode)
    {
        //dd($result);
        $response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];

        return response()->json($response, $responseCode);
    }
    public function successResponse2($result, $roaster_hours,$roaster_count,$working_count, $working_hours, $net_pay, $message, $responseCode)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'roaster_hours' => $roaster_hours,
            'working_hours' => $working_hours,
            'working_count' => $working_count,
            'roaster_count' => $roaster_count,
            'net_pay' => $net_pay,
            'message' => $message,
        ];

        return response()->json($response, $responseCode);
    }


    /**
     * return error response.
     *
     * @return \Illuminate\Http\Response
     */
    public function errorResponse($error, $errorMessages = [], $code = 404)
    {


        try {
            $response = [
                'success' => false,
                'message' => $error,
            ];


            if(!empty($errorMessages)){
                $response['data'] = $errorMessages;
            }


            return response()->json($response, $code);
        } catch (\Throwable $th) {
            return response()->json( $th->getMessage());
        }
    }
}
