<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'Sales') {
            $leads = Lead::where('user_id', Auth::id())->get();
        } else {
            $leads = Lead::all();
        }

        return view('leads.index', compact('leads'));
    }
}
