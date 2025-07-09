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
    
    public function consultant()
    {
        return view('customers.pages.consultant');
    }

    public function blog()
    {
        return view('customers.pages.blog');
    }

    public function contact()
    {
        return view('customers.pages.contact');
    }
    
    // ABOUT
    public function aboutAnphu()
    {
        return view('customers.pages.about_anphu');
    }

    public function aboutOpenLetter()
    {
        return view('customers.pages.about_open_letter');
    }

    public function aboutCulturalValues()
    {
        return view('customers.pages.about_cultural_values');
    }


    // SERVICES
    public function servicesPermit()
    {
        return view('customers.pages.services_permit');
    }

    public function servicesDesign()
    {
        return view('customers.pages.services_design');
    }

    public function servicesContructionRaw()
    {
        return view('customers.pages.services_construction_raw');
    }

    public function servicesContructionFull()
    {
        return view('customers.pages.services_construction_full');
    }

    // PORTFOLIO
    public function portfolioVilla()
    {
        return view('customers.pages.portfolio_villa');
    }

    public function portfolioTownHouse()
    {
        return view('customers.pages.portfolio_town_house');
    }

    public function portfolioTradingHouse()
    {
        return view('customers.pages.portfolio_trading_house');
    }

    //PRICE
    public function priceFull()
    {
        return view('customers.pages.price_full');
    }
    public function priceRaw()
    {
        return view('customers.pages.price_raw');
    }
    public function priceDesign()
    {
        return view('customers.pages.price_design');
    }
    public function pricePermit()
    {
        return view('customers.pages.price_permit');
    }

}
