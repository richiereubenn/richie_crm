<?php

namespace App\Http\Controllers;
use App\Models\Customer;
use App\Models\Project;
use App\Models\Lead;


use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::with('project.lead')
            ->whereHas('project', function ($q) {
                $q->where('status', 'approved');
            })
            ->get()
            ->groupBy('project.lead_id'); 

        return view('customers.index', compact('customers'));
    }
}
