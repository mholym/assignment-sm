<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use App\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Country::query();
        if ($request->q) {
            $children = Continent::query()->where('name', 'ILIKE', '%'.$request->q.'%')->get(['code']);
            $query->whereIn('continent_code', $children);
        }
        if ($request->sort) {
            if (!strcmp($request['sort'], 'asc')) {
                $query->orderBy('name');
            }
            if (!strcmp($request['sort'], 'desc')) {
                $query->orderBy('name', 'desc');
            }
        }
        $countries = $query->paginate(10);
        return view('countries.index', compact('countries', $countries));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        return view('countries.show', compact('country', $country));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $country_codes = [];
        foreach (Country::all() as $country) {
            $country_codes[] = $country->code;
        }
        $request->validate([
            'code' => ['required', Rule::in($country_codes)],
            'name' => 'required|max:64',
            'full_name' => 'required|max:128',
            'iso3' => 'required|max:3',
            'continent_code' => 'required|max:2',
            'display_order' => 'required|numeric'
        ]);

        $country = Country::create([
            'code' => $request->code,
            'name' => $request->name,
            'full_name' => $request->full_name,
            'iso3' => $request->iso3,
            'continent_code' => $request->continent_code,
            'display_order' => $request->display_order,
        ]);

        return view('countries.show', compact('country', $country));
    }
}
