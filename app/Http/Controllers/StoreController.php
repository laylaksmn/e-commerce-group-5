<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoreRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function create(Request $request): View
    {
        return view('store.create');
    }

    public function store(CreateStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id();
        $data['logo'] = $request->file('logo')->store('store_logo', 'public');;
        $data['is_verified'] = 0;
        $store = Store::create($data);
        return Redirect::route('store.create')->with('status', 'store-created');
    }
}
