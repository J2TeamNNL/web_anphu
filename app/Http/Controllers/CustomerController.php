<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('customers.pages.index');
    }
    

    public function about()
    {
        return view('customers.pages.about');
    }

    public function servicesPermit()
    {
        return view('customers.pages.services_permit');
    }

    public function servicesDesign()
    {
        return view('customers.pages.services_design');
    }

    public function servicesContruction()
    {
        return view('customers.pages.services_construction');
    }


    public function elements()
    {
        return view('customers.pages.elements');
    }

    public function contact()
    {
        return view('customers.pages.contact');
    }

    public function portfolio()
    {
        return view('customers.pages.portfolio');
    }

    public function blog()
    {
        return view('customers.pages.blog');
    }
}
