<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FinancialRecordsResource;
use App\Models\FinancialRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinancialRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = FinancialRecord::latest()->get();
        //  dd($data);

        return new FinancialRecordsResource(true, 'List Data Financial Records', $data);
    }

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


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'counted' => 'required|numeric',
            'category' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        };

        $post = FinancialRecord::create([
            'title' => $request->title,
            'counted' => $request->counted,
            'category' => $request->category,

        ]);

        return new FinancialRecordsResource(true, 'Succes to insert Data Financial Records', $post);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'counted' => 'required|numeric',
            'category' => 'required',
        ]);

        // if ($request->fails()) {
        //     return response()->json();
        // };

        $post = FinancialRecord::find($id);

        $post->update([
            'title' => $request->title,
            'counted' => $request->counted,
            'category' => $request->category,
        ]);

        // $post->save();

        return new FinancialRecordsResource(true, 'Succes to Update Data Financial Records', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $post = FinancialRecord::find($id);
        $post->delete();

        // return response()->json([
        //     'status' => 'success',
        //     'message' => 'Data Berhasil Dihapus',
        // ], 200);

        return new FinancialRecordsResource(true, 'Succes to Delete Data Financial Records', $post);
    }

    public function total()
    {
        $income = FinancialRecord::where('category', 'income')->sum('counted');
        $outcome = FinancialRecord::where('category', 'expense')->sum('counted');
        $total = $income - $outcome;
        $total_format = "Rp." . number_format($total, 2, ',', '.');
        return new FinancialRecordsResource(true, 'Succes to Update Data Financial Records', $total_format);
    }
}
