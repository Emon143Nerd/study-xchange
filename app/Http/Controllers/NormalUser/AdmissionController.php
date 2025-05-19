<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\University\AdmissionCircular;
use App\Models\University\University;
use App\Models\University\UniversityFAQ;
use Illuminate\Http\Request;

class AdmissionController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');

        // Fetch the admission circulars based on the search query
        $admissionCirculars = AdmissionCircular::with('university') // Eager load the university data
        ->where(function($queryBuilder) use ($query) {
            $queryBuilder->where('title', 'like', "%{$query}%")
                ->orWhere('total_fees', 'like', "%{$query}%")
                ->orWhere('min_gpa_req', 'like', "%{$query}%")
                ->orWhereHas('university', function($universityQuery) use ($query) {
                    $universityQuery->where('name', 'like', "%{$query}%")
                        ->orWhere('rank', 'like', "%{$query}%")
                        ->orWhere('tuition_fees', 'like', "%{$query}%")
                        ->orWhere('scholarships', 'like', "%{$query}%")
                        ->orWhere('avg_living_cost', 'like', "%{$query}%")
                        ->orWhere('university_type', 'like', "%{$query}%");
                });
        })
            ->get();

        // Fetch the top 5 universities by rank (for the right sidebar or top university section)
        $topUniversities = University::orderBy('rank', 'asc')->limit(5)->get();

        // Return the search results along with the top universities
        return view('normal-user.admission.index', compact('admissionCirculars', 'topUniversities'));
    }



    public function index()
    {
        $admissionCirculars = AdmissionCircular::with('university:id,name') // Assuming a relationship exists
        ->select('id', 'university_id', 'title', 'description', 'start_date', 'image', 'slug')
            ->get();

        // Fetch the top 5 universities by rank
        $topUniversities = University::orderBy('rank', 'asc')->limit(2)->get();

        return view('normal-user.admission.index',compact('admissionCirculars' , 'topUniversities'));
    }


    public function detail($slug)
    {
        // Fetch the admission circular using the provided slug
        $admissionCircular = AdmissionCircular::where('slug', $slug)->firstOrFail();

        // Fetch the matching FAQs based on the university and subject category
        $faqs = UniversityFAQ::where('university_id', $admissionCircular->university_id)
            ->where('subject_category_id', $admissionCircular->subject_category_id)
            ->where('status', 1) // Optional: Show only active FAQs
            ->get();

        // Pass both the admission circular and the FAQs to the view
        return view('normal-user.admission.detail', compact('admissionCircular', 'faqs'));
    }


    // Compare University
    public function addToCompare(Request $request)
    {
        // Validate the request to ensure 'university_id' and 'admission_circular_id' are provided
        $request->validate([
            'university_id' => 'required|exists:universities,id',
            'admission_circular_id' => 'required|exists:admission_circulars,id',
        ]);

        // Fetch the university data by its ID
        $university = University::findOrFail($request->input('university_id'));

        // Fetch the specific admission circular by its ID
        $admissionCircular = AdmissionCircular::where('id', $request->input('admission_circular_id'))
            ->where('university_id', $university->id)
            ->firstOrFail();

        // Prepare the data to store in session
        $universityData = [
            'id' => $university->id,
            'name' => $university->name,
            'rank' => $university->rank,
            'campus_facilities' => $university->campus_facilities,
            'scholarships' => $university->scholarships,
            'placement_records' => $university->placement_records,
            'residence_facilities' => $university->residence_facilities,
            'food_facilities' => $university->food_facilities,
            'avg_living_cost' => $university->avg_living_cost,
            // Admission circular details
            'admission_circular_id' => $admissionCircular->id,
            'circular_title' => $admissionCircular->title,
            'circular_total_fees' => $admissionCircular->total_fees,
            'min_gpa_required' => $admissionCircular->min_gpa_req,
            'application_start_date' => $admissionCircular->start_date,
            'application_end_date' => $admissionCircular->end_date,
        ];

        // Retrieve the existing comparison universities from session
        $compareUniversities = session('compare_universities', []);

        // Check if the admission circular is already in the list
        $isAlreadyAdded = collect($compareUniversities)->contains(function ($item) use ($admissionCircular) {
            return $item['admission_circular_id'] === $admissionCircular->id;
        });

        if ($isAlreadyAdded) {
            return redirect()->back()->with('message', 'This admission circular is already in the comparison list!');
        }

        // Add the new admission circular to the list
        $compareUniversities[] = $universityData;

        // Store the updated list back into the session
        session(['compare_universities' => $compareUniversities]);

        // Redirect back with success message
        return redirect()->back()->with('message', 'Admission circular added to compare list!');
    }



    public function removeFromCompare(Request $request)
    {
        $admissionCircularId = $request->input('admission_circular_id');
        $compareUniversities = session('compare_universities', []);

        // Filter out the specific admission circular using its ID
        $compareUniversities = array_filter($compareUniversities, function($university) use ($admissionCircularId) {
            return $university['admission_circular_id'] != $admissionCircularId;
        });

        // Reindex the array to avoid non-sequential indices
        $compareUniversities = array_values($compareUniversities);

        // Update the session
        session(['compare_universities' => $compareUniversities]);

        // Redirect to the compare universities page with a success message
        return redirect()->route('normal-user.admission.compare-university')->with('message', 'Admission circular removed from comparison list.');
    }




    public function viewCompare()
    {
        // Get the universities from session or database for comparison
        $compareUniversities = session('compare_universities', []);

        // Check if the data is being stored correctly in the session
//        dd($compareUniversities); // This will dump the session data, and stop execution here

        return view('normal-user.admission.compare-university', compact('compareUniversities'));
    }

}
