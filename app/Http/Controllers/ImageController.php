<?php

namespace App\Http\Controllers;

use App\Models\image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    public function show($image)
    {
        $path = storage_path("app/image/{$image}");
        return response()->file($path);
    }
    public function edit(image $image)
    {
        //
    }

    public function update(Request $request, image $image)
    {
        //
    }

    public function destroy(image $image)
    {
        //
    }
}
