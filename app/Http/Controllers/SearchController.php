<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    //
    public function search($name)
    {
        return Contact::select('id', 'name', 'position_id', 'location_id', 'profile_photo_path')->where('name', 'like', '%' . $name . '%')->get();
    }
}
