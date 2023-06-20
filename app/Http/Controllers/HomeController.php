<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getrooms(){
        return view('frontend.rooms');
    }

    public function getintroduction(){
        return view('frontend.introduction');
    }

    public function getservices(){
        return view('frontend.services');
    }

    public function getdetails(){
        return view('frontend.details');
    }

    public function getcontact(){
        return view('frontend.contact');
    }
    public function gettermsofservice(){
        return view('frontend.terms-of-service');
    }





    
}
