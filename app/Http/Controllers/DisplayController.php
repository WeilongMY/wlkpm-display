<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DisplayController extends Controller
{
    public function index()
    {
        return view('config.display.index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->file('image')) {
            $path = Storage::putFile('image', $request->file('image'));
            $request->file('image')->move(public_path('/img/skin'), 'background.png');
        }

        if($request->greeting) {
            $jsonString = Storage::disk('public')->get('config.json');
            $data = json_decode(trim($jsonString));

            $data->greeting = $request->greeting;

            $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

            Storage::disk('public')->put('config.json',stripslashes($newJsonString));
        }

        if($request->message) {
            $jsonString = Storage::disk('public')->get('config.json');
            $data = json_decode(trim($jsonString));

            $data->message = $request->message;

            $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

            Storage::disk('public')->put('config.json',stripslashes($newJsonString));
        }

        if($request->info) {
            $jsonString = Storage::disk('public')->get('config.json');
            $data = json_decode(trim($jsonString));

            $data->info = $request->info;

            $newJsonString = json_encode($data, JSON_PRETTY_PRINT);

            Storage::disk('public')->put('config.json',stripslashes($newJsonString));
        }

        return redirect('/');
    }
}
