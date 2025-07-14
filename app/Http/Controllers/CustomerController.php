<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Portfolio;
use App\Models\Article;

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
    public function projectIndex($type = null)
    {
        $allTypes = Portfolio::getTypes();

        if ($type && !array_key_exists($type, $allTypes)) {
            abort(404);
        }
        
        $portfolios = Portfolio::query()
            ->when($type, fn($q) => $q->where('type', $type))
            ->get();

        $categories = [];
        foreach (Portfolio::getCategories() as $typeKey => $catGroup) {
            foreach ($catGroup as $key => $label) {
                $categories[] = [
                    'type' => $typeKey,
                    'key' => $key,
                    'class' => $typeKey . ' ' . $key,
                    'name' => $label,
                ];
            }
        }
        
        $projectTitle = 'Tất cả công trình';
        if ($type && array_key_exists($type, $allTypes)) {
            $projectTitle = 'Công trình ' . $allTypes[$type];
        }

        return view('customers.pages.projects', [
            'portfolios' => $portfolios,
            'types' => $allTypes,
            'categories' => $categories,
            'selectedType' => $type,
            'projectTitle' => $projectTitle
        ]);
    }

    public function blogIndex($type = null)
    {
        $types = Article::getTypes();


        if ($type && !array_key_exists($type, $types)) {
            abort(404);
        }
        
        $articles = Article::query()
            ->when($type, fn($q) => $q->where('type', $type))
            ->get();


        $articleTitle = 'Tất cả hoạt động';
        if ($type && array_key_exists($type, $types)) {
            $articleTitle = 'Công trình ' . $types[$type];
        }

        
        return view('customers.pages.blogs', [
            'articles' => $articles,
            'types' => $types,
            'selectedType' => $type,
            'articleTitle' => $articleTitle
        ]);
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
