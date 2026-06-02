<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gotra;
use App\Imports\GotrasImport;
use App\Exports\GotrasExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class GotraController extends Controller
{
    public function index()
    {
        $data = Gotra::latest()->get();
        return view('admin.gotras.index', compact('data'));
    }

    public function store(Request $request)
    {
        Gotra::create(['gotra'=>$request->gotra]);
        return back()->with('success','Gotra Added');
    }

    public function update(Request $request, $id)
    {
        Gotra::find($id)->update($request->only('gotra','status'));
        return back()->with('success','Updated');
    }

    public function destroy($id)
    {
        Gotra::find($id)->delete();
        return back()->with('success','Deleted');
    }

    // Import view & logic
    public function importForm()
    {
        return view('admin.gotras.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        Excel::import(new GotrasImport, $request->file('file'));
        return redirect()->route('admin.gotras.index')->with('success', 'Gotra imported successfully.');
    }

    public function export()
    {
        return Excel::download(new GotrasExport, 'gotras_'.date('Y-m-d').'.xlsx');
    }
}