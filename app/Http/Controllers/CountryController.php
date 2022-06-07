<?php

namespace App\Http\Controllers;

use App\Models\Continent;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use \Validator;

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
        return $query->paginate(10);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country, $id)
    {
        return Country::find($id);
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
        $continent_codes = [];
        foreach (Country::all() as $country)
            $country_codes[] = $country->code;
        foreach (Continent::all() as $continent)
            $continent_codes[] = $continent->code;

        $rules = [
            'code' => ['required', 'max:2', Rule::notIn($country_codes)],
            'name' => 'required|max:64',
            'full_name' => 'required|max:128',
            'iso3' => 'required|max:3',
            'continent_code' => ['required', 'max:2', Rule::In($continent_codes)],
            'display_order' => 'required|numeric',
            'number' => 'required|numeric|digits_between:1,3'
        ];

        $response = array('response' => '', 'success'=>false);
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            $response['errors'] = $validator->messages();
        } else {
            $country = Country::create([
                'code' => $request->code,
                'name' => $request->name,
                'full_name' => $request->full_name,
                'iso3' => $request->iso3,
                'continent_code' => $request->continent_code,
                'display_order' => $request->display_order,
                'number' => $request->number
            ]);
            $response = array('response' => $country, 'success'=>true);
        }
        return $response;
    }
}
