<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\HazardData;

class HazardDataController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->get('search');

        // Fetch only the logged-in user's records
        $hazards = HazardData::where('user_id', Auth::user()->id)
            ->when($searchQuery, function ($query) use ($searchQuery) {
                return $query->where('barangay', 'like', '%' . $searchQuery . '%');
            })
            ->orderBy('barangay', 'asc')
            ->get();

        return view('dashboard2', compact('hazards'));
    }

    public function create()
    {
        return view('dashboard2.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'barangay' => 'required|string|max:255',
            'hazard_type.*' => 'required|string|max:255',
            'families_affected.*' => 'required|integer',
            'persons.*' => 'required|integer',
        ]);

        // Loop through the hazard data and store each record
        foreach ($request->hazard_type as $key => $hazardType) {
            HazardData::create([
                'user_id' => Auth::user()->id,  // Store the authenticated user's ID
                'barangay' => $request->barangay,
                'hazard_type' => $hazardType,
                'families_affected' => $request->families_affected[$key],
                'persons' => $request->persons[$key],
            ]);
        }

        return redirect()->route('dashboard2')->with('success', 'Hazard Data Added');
    }

    public function edit($barangay)
    {
        $hazards = HazardData::where('barangay', $barangay)
            ->where('user_id', Auth::user()->id)
            ->get();

        if ($hazards->isEmpty()) {
            return redirect()->route('dashboard2')->with('error', 'No data found for this barangay.');
        }

        return view('dashboard2.edit', compact('hazards', 'barangay'));
    }

    public function update(Request $request, $barangay)
    {
        $request->validate([
            'barangay' => 'required|string|max:255',
            'hazard_type.*' => 'required|string|max:255',
            'families_affected.*' => 'required|integer',
            'persons.*' => 'required|integer',
        ]);

        // Delete the existing data for that barangay and current user
        HazardData::where('barangay', $barangay)
            ->where('user_id', Auth::user()->id)
            ->delete();

        // Loop through the new hazard data and update the records
        foreach ($request->hazard_type as $key => $hazardType) {
            HazardData::create([
                'user_id' => Auth::user()->id,  // Store the authenticated user's ID
                'barangay' => $request->barangay,
                'hazard_type' => $hazardType,
                'families_affected' => $request->families_affected[$key],
                'persons' => $request->persons[$key],
            ]);
        }

        return redirect()->route('dashboard2')->with('success', 'Hazard Data Updated');
    }

    public function destroy($barangay)
    {
        // Delete the hazard data for the specified barangay and current user
        HazardData::where('barangay', $barangay)
            ->where('user_id', Auth::user()->id)
            ->delete();

        return redirect()->route('dashboard2')->with('success', 'Hazard Data for Barangay deleted');
    }

    public function exportHazards()
    {
        // Fetch hazard data for the authenticated user
        $hazards = HazardData::where('user_id', Auth::id())->get();

        $headers = ["Barangay", "Hazard Type", "Families Affected", "Persons"];
        $fileName = "barangay_hazard_data.xls";
        $content = implode("\t", $headers) . "\n";

        // Prepare data for export
        foreach ($hazards as $hazard) {
            $content .= implode("\t", [
                $hazard->barangay,
                $hazard->hazard_type,
                $hazard->families_affected,
                $hazard->persons
            ]) . "\n";
        }

        return response($content)
            ->header('Content-Type', 'application/vnd.ms-excel')
            ->header('Content-Disposition', "attachment; filename={$fileName}");
    }
}
