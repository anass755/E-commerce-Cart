<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SampleEmail;

class ContactController extends Controller
{
    public function index(){
        return view('contact.index');
    }
    public function store(request $request){
        Mail::to('recipient@example.com')->send(new SampleEmail());
            return  redirect()->route('contact.index');

          
        
    }
}
