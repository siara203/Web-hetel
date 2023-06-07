<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getrooms(){
        return view('homepage.rooms');
    }

    public function getintroduction(){
        return view('homepage.introduction');
    }

    public function getservices(){
        return view('homepage.services');
    }

    public function getdetails(){
        return view('homepage.details');
    }

    public function getcontact(){
        return view('homepage.contact');
    }





    
}
