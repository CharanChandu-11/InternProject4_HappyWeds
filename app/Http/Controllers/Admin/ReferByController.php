<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ReferBy;
use App\Imports\ReferBysImport;
use App\Exports\ReferBysExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ReferByController extends Controller
{
    public function index()
    {
        $data = ReferBy::latest('created_at')->get();
        return view('admin.refer-by.index', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        ReferBy::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'status' => $request->status ?? 1,
        ]);
        
        return back()->with('success', 'Refer By Added');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $referBy = ReferBy::findOrFail($id);
        $referBy->fill($request->only('name', 'email', 'phone', 'address', 'status'));
        $referBy->save();
        return back()->with('success', 'Updated');
    }

    public function destroy($id)
    {
        $referBy = ReferBy::findOrFail($id);
        $referBy->delete();
        return back()->with('success', 'Deleted');
    }

    public function importForm()
    {
        return view('admin.refer-by.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new ReferBysImport, $request->file('file'));
        return redirect()->route('admin.refer-by.index')->with('success', 'Refer By imported successfully.');
    }

    public function export()
    {
        return Excel::download(new ReferBysExport, 'refer_by_' . date('Y-m-d') . '.xlsx');
    }
}