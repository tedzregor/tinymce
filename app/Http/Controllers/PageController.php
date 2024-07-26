<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Page;
use Symfony\Component\HttpFoundation\Response;

class PageController extends Controller
{
    public function show(){
        // Retrieve data from the model
        $data = Page::all(); // or any method to get the data you need

        // Pass the data to the view using compact
        return view('welcome', compact('data'));
    }
    public function savePage(Request $request) {

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        // Create a new post
        $page = Page::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'content' => $request->input('content'),
        ]);

        $htmlContent = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>'.$request->input('title').'</title>
        </head>
        <body>'.$request->input('content').'</body></html>';
        
        // Specify the path where the HTML file should be saved
        $filePath = 'public/'.$request->input('title').'.html';

        // Store the HTML content in the file
        Storage::put($filePath, $htmlContent);

        // Return a JSON response
        return response()->json([
            'success' => true,
            'page' => $page,
        ]);

    }

    public function download($filename)
    {
        $path = public_path('storage/'. $filename);

         // Check if the file exists
         if (!file_exists($path)) {
            abort(404, 'File not found.');
        }

        // Return the file as a response
        return response()->download($path);
    }
}
