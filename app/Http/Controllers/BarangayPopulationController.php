<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\BarangayPopulation;

class BarangayPopulationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search');

        // Fetch only the logged-in user's records
        $barangays = BarangayPopulation::where('user_id', Auth::user()->id)
            ->when($search, function ($query) use ($search) {
                return $query->where('name', 'like', '%' . $search . '%');
            })
            ->orderBy('name', 'asc')
            ->get();

        return view('dashboard1', compact('barangays'));
    }

    public function create()
    {
        return view('dashboard1.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'households' => 'required|integer',
            'families' => 'required|integer',
            'males' => 'required|integer',
            'females' => 'required|integer',
            'lgbtq' => 'required|integer',
        ]);

        $population = $request->males + $request->females + $request->lgbtq;

        BarangayPopulation::create([
            'name' => $request->name,
            'households' => $request->households,
            'families' => $request->families,
            'males' => $request->males,
            'females' => $request->females,
            'lgbtq' => $request->lgbtq,
            'population' => $population,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('dashboard1')->with('success', 'Barangay Population Data Added');
    }

    public function edit($id)
    {
        $barangay = BarangayPopulation::where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();
        return view('dashboard1.edit', compact('barangay'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'households' => 'required|integer',
            'families' => 'required|integer',
            'males' => 'required|integer',
            'females' => 'required|integer',
            'lgbtq' => 'required|integer',
        ]);

        $barangay = BarangayPopulation::where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();

        $population = $request->males + $request->females + $request->lgbtq;

        $barangay->update([
            'name' => $request->name,
            'households' => $request->households,
            'families' => $request->families,
            'males' => $request->males,
            'females' => $request->females,
            'lgbtq' => $request->lgbtq,
            'population' => $population,
        ]);

        return redirect()->route('dashboard1')->with('success', 'Barangay Population Data Updated');
    }

    public function destroy($id)
    {
        $barangay = BarangayPopulation::where('id', $id)->where('user_id', auth()->user()->id)->firstOrFail();
        $barangay->delete();

        return redirect()->route('dashboard1')->with('success', 'Data Deleted');
    }

    public function exportBarangays()
    {
        $barangays = BarangayPopulation::where('user_id', auth()->user()->id)->get();

        $headers = ["Name", "Household", "Families", "Male", "Female", "LGBTQ", "Total Population"];

        $fileName = "barangays_data.xls";
        $content = implode("\t", $headers) . "\n";

        foreach ($barangays as $barangay) {
            $content .= implode("\t", [
                $barangay->name,
                $barangay->households,
                $barangay->families,
                $barangay->males,
                $barangay->females,
                $barangay->lgbtq,
                $barangay->population
            ]) . "\n";
        }

        return response($content)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', "attachment; filename={$fileName}");
    }
}
