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

    public function create()
    {
        return view('leads.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string|max:255',
        ]);

        Lead::create([
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('leads.index')
            ->with('success', 'Lead has been successfully created!');;
    }

    public function edit(Lead $lead)
    {
        if (Auth::user()->role === 'Sales' && $lead->user_id != Auth::id()) {
            abort(403);
        }
        return view('leads.create', compact('lead'));
    }

    public function update(Request $request, Lead $lead)
    {
        if (Auth::user()->role === 'Sales' && $lead->user_id != Auth::id()) {
            abort(403);
        }

        $request->validate([
            'name' => 'required|string|min:3|max:100',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,15',
            'address' => 'required|string|max:255',
        ]);

        $lead->update($request->all());

        return redirect()->route('leads.index')
            ->with('success', 'Lead has been successfully edited!');
    }

    public function destroy(Lead $lead)
    {
        if (Auth::user()->role === 'Sales' && $lead->user_id != Auth::id()) {
            abort(403);
        }

        $lead->delete();
        return redirect()->route('leads.index');
    }
}
