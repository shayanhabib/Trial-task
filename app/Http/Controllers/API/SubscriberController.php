<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Subscriber;
use Validator;
use App\Http\Resources\SubscriberRef as SubscriberResource;
use Illuminate\Support\Facades\DB;

class SubscriberController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Subscribers = DB::table('subscribers')->get();
        return $this->sendResponse($Subscribers, 'Subscribers retrieved successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'name' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $Subscriber = DB::table('subscribers')->insert([
            'name' => $input['name'],
            'email' => $input['email']
        ]);

        return $this->sendResponse(new SubscriberResource($Subscriber), 'Subscriber created successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $Subscriber = DB::table('subscribers')->where('id', $request['id'])->get();
        return $this->sendResponse($Subscriber, 'Subscriber retrieved successfully.');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required',
            'name' => 'required',
            'email' => 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }

        $Subscriber = DB::table('subscribers')->where('id', $input['id'])->update([
            'name' => $input['name'],
            'email' => $input['email']
        ]);

        return $this->sendResponse(new SubscriberResource($Subscriber), 'Subscriber updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
        
        $Subscriber = DB::table('subscribers')->where('id', $input['id'])->delete();

        return $this->sendResponse([], 'Subscriber deleted successfully.');
    }
}