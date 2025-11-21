<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Lead;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'Sales') {
            $projects = Project::whereHas('lead', function ($q) {
                $q->where('user_id', Auth::id());
            })->get();
        } else {
            $projects = Project::all();
        }

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $leads = Lead::where('user_id', Auth::id())->get();
        $products = Product::all();

        return view('projects.create', compact('leads', 'products'));
    }

    public function detail(Project $project)
    {
        $project->load(['lead', 'product']);

        return view('projects.detail', compact('project'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lead_id' => 'required|exists:leads,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $project = Project::create([
            'lead_id' => $request->lead_id,
            'product_id' => $request->product_id,
            'status' => 'pending'
        ]);

        return redirect()->route('projects.index')
            ->with('success', 'Project has been successfully created!');
    }


    public function approve(Project $project, Request $request)
    {
        if (Auth::user()->role !== 'Manager')
            abort(403);

        $project->update([
            'status' => 'approved',
            'approval_note' => $request->approval_note
        ]);

        Customer::create([
            'project_id' => $project->id,
            'payment_status' => 'unpaid'
        ]);

        return redirect()->route('projects.index');
    }

    public function reject(Project $project, Request $request)
    {
        if (Auth::user()->role !== 'Manager')
            abort(403);

        $project->update([
            'status' => 'rejected',
            'approval_note' => $request->approval_note
        ]);

        return redirect()->route('projects.index');
    }

    public function destroy(Project $project)
    {
        if (Auth::user()->role !== 'Sales')
            abort(403);

        $project->delete();

        return redirect()->route('projects.index');
    }
}

