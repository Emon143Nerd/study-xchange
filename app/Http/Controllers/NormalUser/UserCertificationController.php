<?php

namespace App\Http\Controllers\NormalUser;

use App\Http\Controllers\Controller;
use App\Models\UserCertification;
use App\Models\UserEducation;
use Illuminate\Http\Request;

//class UserCertificationController extends Controller
//{
//    public function store(Request $request)
//    {
//        // Validate the certificates array
//        $request->validate([
//            'certificates' => 'array',
//            'certificates.*.certificate_name' => 'required|string|max:255',
//            'certificates.*.issuing_organization' => 'required|string|max:255',
//            'certificates.*.issue_date' => 'required|date',
//            'certificates.*.expiration_date' => 'nullable|date',
//            'certificates.*.certificate_image' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048', // Optional but must be a valid file
//            'certificates.*.delete' => 'nullable|boolean', // For deletion check
//            'certificates.*.id' => 'nullable|integer|exists:user_certifications,id', // For updating existing records
//        ], [
//            'certificates.*.certificate_name.required' => 'The certification name is required.',
//            'certificates.*.issuing_organization.required' => 'The issuing organization is required.',
//            'certificates.*.issue_date.required' => 'The issue date is required.',
//            'certificates.*.certificate_image.file' => 'The certificate image must be a valid file.',
//            'certificates.*.certificate_image.mimes' => 'The certificate image must be a file of type: jpg, jpeg, png, pdf.',
//            'certificates.*.certificate_image.max' => 'The certificate image may not be greater than 2MB.',
//        ]);
//
//        $userId = $request->user_id ?? auth()->id();
//
//        if (!$userId) {
//            return redirect()->back()->withErrors('User ID is required.');
//        }
//
//        foreach ($request->certificates as $certificateData) {
//            // Check if the certificate is marked for deletion
//            if (isset($certificateData['delete']) && $certificateData['delete'] == 1) {
//                if (isset($certificateData['id'])) {
//                    $certificate = UserCertification::find($certificateData['id']);
//                    if ($certificate) {
//                        $certificate->delete(); // Delete the certificate from the database
//                    }
//                }
//                continue; // Skip further processing for this certificate
//            }
//
//            // Handle certificate creation or update
//            if (isset($certificateData['certificate_image']) && $certificateData['certificate_image']->isValid()) {
//                $certificateData['certificate_image'] = $certificateData['certificate_image']->store('certificates', 'public');
//            }
//
//            UserCertification::updateOrCreate(
//                ['id' => $certificateData['id'] ?? null],
//                [
//                    'user_id' => $userId,
//                    'certification_name' => $certificateData['certification_name'],
//                    'issuing_organization' => $certificateData['issuing_organization'],
//                    'issue_date' => $certificateData['issue_date'],
//                    'expiration_date' => $certificateData['expiration_date'] ?? null,
//                    'image' => $certificateData['certificate_image'] ?? null,
//                ]
//            );
//        }
//
//        return redirect()->back()->with('success', 'Certifications updated successfully!');
//    }
//
//
//
//}

class UserCertificationController extends Controller
{
    public function store(Request $request)
    {
        // Validate the certificates array
        $request->validate([
            'certificates' => 'array',
            'certificates.*.certification_name' => 'required|string|max:255',
            'certificates.*.issuing_organization' => 'required|string|max:255',
            'certificates.*.issue_date' => 'required|date',
            'certificates.*.expiration_date' => 'nullable|date',
            'certificates.*.certificate_image' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'certificates.*.delete' => 'nullable|boolean',
            'certificates.*.id' => 'nullable|integer|exists:user_certifications,id',
        ], [
            'certificates.*.certification_name.required' => 'The certification name is required.',
            'certificates.*.issuing_organization.required' => 'The issuing organization is required.',
            'certificates.*.issue_date.required' => 'The issue date is required.',
            'certificates.*.certificate_image.file' => 'The certificate image must be a valid file.',
            'certificates.*.certificate_image.mimes' => 'The certificate image must be a file of type: jpg, jpeg, png, pdf.',
            'certificates.*.certificate_image.max' => 'The certificate image may not be greater than 2MB.',
        ]);

        $userId = auth()->id();

        if (!$userId) {
            return redirect()->back()->withErrors('User authentication is required.');
        }

        foreach ($request->certificates as $index => $certificateData) {
            // Check if the certificate is marked for deletion
            if (isset($certificateData['delete']) && $certificateData['delete'] == 1) {
                if (isset($certificateData['id'])) {
                    UserCertification::where('id', $certificateData['id'])->delete();
                }
                continue;
            }

            // Prepare data for saving
            $saveData = [
                'user_id' => $userId,
                'certification_name' => $certificateData['certification_name'],
                'issuing_organization' => $certificateData['issuing_organization'],
                'issue_date' => $certificateData['issue_date'],
                'expiration_date' => $certificateData['expiration_date'] ?? null,
            ];

            // Handle file upload
            if (isset($certificateData['certificate_image']) && $certificateData['certificate_image']) {
                $file = $certificateData['certificate_image'];
                $filename = time() . '_' . $file->getClientOriginalName();
                $path = $file->storeAs('certificates', $filename, 'public');
                $saveData['image'] = $path;
            }

            // Update or Create the certification
            UserCertification::updateOrCreate(
                ['id' => $certificateData['id'] ?? null],
                $saveData
            );
        }

        return redirect()->back()->with('success', 'Certifications updated successfully!');
    }
}
