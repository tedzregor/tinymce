<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
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

        // Return a JSON response
        return response()->json([
            'success' => true,
            'page' => $page,
        ]);

    }
}
