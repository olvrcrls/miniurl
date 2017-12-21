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
            'urlAlias' => 'string|nullable|max:30|min:5'
        ]);

        $existingUrl = Link::select('url_id')->where('name', '=', str_slug(request('urlAlias')))->get();
        /**
        * checking if the URL alias already existed, if it does then 
        * we will generate a random one instead for the user.
        *
        */
        if ($existingUrl->count()) {
            $urlAlias = $this->generateRandomStrings();
            $aliasAlreadyExistsFlag = true;
        } else { $urlAlias = request('urlAlias'); $aliasAlreadyExistsFlag = false; }

        /**
        * checking if the user input an alias for his URL
        * if the user hasn't then we will assume he wants
        * a random alias instead.
        */
        $actualUrl = request('originalUrl');
        if (request()->has('urlAlias')) {
            $new_link = Link::create([
                'name' => $urlAlias,
                'actual_url' => $actualUrl
            ]);
        } else {
            $generatedAlias = $this->generateRandomStrings();
            $new_link = Link::create([
                'name' => $generatedAlias,
                'actual_url' => $actualUrl
            ]);
        }

        if ($aliasAlreadyExistsFlag) {
            return redirect()->route('url.results', ['url' => $new_link])->with('status', "Your URL alias is not available or has been already taken by another user. So we generated you a random one instead to use.");
        } else {
            return redirect()->route('url.results', ['url' => $new_link]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Url $url
     * @return \Illuminate\Http\Response
     */
    public function result(\App\Models\Url $url)
    {
        return view('results', compact('url'));
    }

    /**
     * Display the specified resource and redirecting to the actual URL.
     *
     * @param  \App\Models\Url $url
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Url $url)
    {
        if (str_contains($url->actual_url, 'https://')) {
            header("Location: $url->actual_url"); exit; }
        else {
            header("Location: http://$url->actual_url"); exit;
        }
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

        $strRandom = str_random(10);

        return $strRandom;
    }
}
