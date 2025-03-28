<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerType;
use App\Models\User;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $clients = Customer::all();
        $types = CustomerType::all();
        $s_number = Customer::generateSerialNumber();
        return view('admin.clients.index', compact('clients', 'types', 's_number'));
    }

    /**

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_ar'               => 'required|string|max:255',
                'name_en'               => 'required|string|max:255',
                'type'                  => 'required',
                'identity_number'       => 'nullable|string|max:10',
                'commercial_record'     => 'nullable|string|max:10',
                'tax_number'            => 'nullable|string|max:16',
                'brand_name'            => 'nullable|string|max:50',
                'phone'                 => 'nullable|string|max:14',
                'mobile'                => 'nullable|string|max:14',
                'email'                 => 'nullable|string|email|max:255',
                'website'               => 'nullable|string|max:255',
                'notes'                 => 'nullable|string|max:255',
                'is_active'             => 'required',
            ]);

            $validated['is_active'] = $validated['is_active'] == 1 ? true : false;
            $validated['created_by'] = User::currentUserId();
            $validated['updated_by'] = User::currentUserId();
            $validated['s_number'] = Customer::generateSerialNumber();

            // استخدام create بدلاً من fill و save
            $client = new Customer();
            $client->fill($validated);
            $client->save();

            return redirect()->back()->with('success', __('clients.created_successfully'));
        } catch (\Exception $th) {
            return redirect()->back()->with('error', __('clients.create_failed') . ': ' . $th->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        $client = Customer::with('projects')->findOrFail($id);
        $client->invoices = [];
        $client->payments = [];
        $client->notes = [];

        $types = CustomerType::all();
        return view('admin.clients.show', compact('client', 'types'));
    }

    /**
     * Display the specified resource.
     */
    public function projects($id)
    {
        $client = Customer::find($id);
        if (!$client) {
            return redirect()->back()->with('error', __('clients.not_found'));
        }
        $types = CustomerType::all(); // 
        return view('admin.clients.projects.index', compact('client', 'types'));
    }

    /**
     * Display the specified resource.
     */
    public function display(Customer $client)
    {
        //
        $types = CustomerType::all();
        return view('admin.clients.show', compact('client', 'types'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
        $client = Customer::find($id);
        if (!$client) {
            return redirect()->back()->with('error', __('clients.not_found'));
        }
        $types = CustomerType::all();
        return view('admin.clients.edit', compact('client', 'types'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $client = Customer::find($id);
        if (!$client) {
            return redirect()->back()->with('error', __('clients.not_found'));
        }
        
        try {
            $validated = $request->validate([
                'name_ar'           => 'required|string|max:255',
                'name_en'           => 'required|string|max:255',
                'type'              => 'required',
                'identity_number'   => 'nullable|string|max:10',
                'commercial_record' => 'nullable|string|max:10',
                'tax_number'        => 'nullable|string|max:16',
                'brand_name'        => 'nullable|string|max:50',
                'phone'             => 'nullable|string|max:14',
                'mobile'            => 'nullable|string|max:14',
                'email'             => 'nullable|string|email|max:255',
                'website'           => 'nullable|string|max:255',
                'city'              => 'required|string|max:50',
                'address'           => 'nullable|string|max:255',
                'notes'             => 'nullable|string|max:255',
            ]);

            $validated['is_active']     = isset($request->is_active) && $request->is_active == 1 ? true : false;
            $validated['updated_by']    = User::currentUserId();

            // تحديث البيانات مع التحقق من القيم الفريدة
            $client->fill($validated);
            $client->update();
            
            return redirect()->back()->with('success', __('clients.updated_successfully'));
        } catch (QueryException $th) {
            return redirect()->back()->with('error', __('clients.update_failed') . ': ' . $th->getMessage());
        }
    }

    public function delete(Client $client)
    {
        // Hide the client temporarily
        $client->deleted_at = now();
        try {
            $client->save();
            return redirect()->back()->with('success', __('clients.hide_successfully'));
        } catch (QueryException $th) {
            return redirect()->back()->with('error', __('clients.hide_failed') . ': ' . $th->getMessage());
        }
    }

    public function destroy(Client $client)
    {
        // Delete the client permanently
        try {
            $client->delete();
            return redirect()->back()->with('success', __('clients.deleted_successfully'));
        } catch (QueryException $th) {
            return redirect()->back()->with('error', __('clients.delete_failed') . ': ' . $th->getMessage());
        }
    }
}
