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
        $query = Customer::with('project.lead')
            ->whereHas('project', function ($q) {
                $q->where('status', 'approved'); 
            });

        if (auth()->user()->role === 'Sales') {
            $query->whereHas('project.lead', function ($q) {
                $q->where('user_id', auth()->id());
            });
        }

        $customers = $query->get()->groupBy('project.lead_id');

        return view('customers.index', compact('customers'));
    }


    public function detail($lead)
    {
        $projects = Project::with('product')
            ->where('lead_id', $lead)
            ->where('status', 'approved')
            ->get();

        $lead = Lead::findOrFail($lead);

        return view('customers.detail', compact('lead', 'projects'));
    }

    public function pay($project)
    {
        $project = Project::findOrFail($project);

        $customer = Customer::firstOrCreate([
            'project_id' => $project->id
        ]);

        $subscription = $project->product->subscription_period ?? 30;
        $expired = now()->addDays($subscription);

        $customer->update([
            'payment_status' => 'paid',
            'payment_date' => now(),
            'expired_date' => $expired
        ]);

        return back()->with('success', 'Payment successfully updated!');
    }
}
