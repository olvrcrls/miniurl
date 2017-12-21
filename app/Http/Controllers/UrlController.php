<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url as Link;
class UrlController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $this->validate(request(), [
            'originalUrl' => 'required',
            'urlAlias' => 'string|nullable|unique:urls,name|max:30|min:5'
        ]);

        if (request()->has('urlAlias')) {
            $new_link = Link::create([
                'name' => request('urlAlias'),
                'actualUrl' => request('originalUrl')
            ]);
        } else {
            $generatedAlias = $this->generateRandomStrings();
            $new_link = Link::create([
                'name' => $generatedAlias,
                'actualUrl' => request('originalUrl')
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    private function generateRandomStrings() {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $strRandom = '';

        for ($i = 0; $i <= 13; $i++) {
            $strRandom = $characters[rand(0, strlen($characters))];
        }

        return $strRandom;
    }
}
