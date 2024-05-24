<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTripRequest;
use App\Models\Dto\TripDto;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $request)
    {
        var_dump($request->all());
        $dto = new TripDto(...$request->all());
        $dto->setUserId(auth()->user()->id);
        var_dump(111);
        exit();
        // return Language::create($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // return Language::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // return tap(Language::find($id))->update($data)->fresh();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
