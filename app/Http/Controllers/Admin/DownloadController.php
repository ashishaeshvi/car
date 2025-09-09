<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Exception;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use Log;

class DownloadController extends Controller
{
    public function pdfDownload(Request $request)
    {
        try {
            $candidate = Candidate::findOrFail($request->id);
            switch (true) {
                case str_contains($request->type, 'agreement_'):
                    $view = $request->type == 'agreement_QATAR' ? 'admin.pdflayouts.agreement_qatar' : ($request->type == 'agreement_OMAN' ? 'admin.pdflayouts.agreement_oman' : 'admin.pdflayouts.agreement');
                    $html = view($view, compact('candidate'))->render();
                    $name = 'AGREEMENT.pdf';
                    return downloadHelper($html, $name, $request->type);
                case $request->type == 'company':
                    $html = view('admin.pdflayouts.request_company', compact('candidate'))->render();  
                    $name = 'REQUEST_COMPANY.pdf';
                    return downloadHelper($html, $name);
                case $request->type == 'individual':
                    $html = view('admin.pdflayouts.request_individual', compact('candidate'))->render();
                    $name = 'REQUEST_INDIVIDUAL.pdf';
                    return downloadHelper($html, $name);
                case $request->type == 'power_of_attorny':
                    $html = view('admin.pdflayouts.power_of_attorny', compact('candidate'))->render();
                    $name = 'POWER_OFF_ATTORNEY.pdf';
                    return downloadHelper($html, $name);
                case $request->type == 'scan':
                    $html = view('admin.pdflayouts.scan', compact('candidate'))->render();
                    $name = 'SCAN.pdf';
                    return downloadHelper($html, $name, $request->type);
                case $request->type == 'affidavit':
                    $html = view('admin.pdflayouts.affidavit', compact('candidate'))->render();
                    $name = 'AFFIDAVIT.pdf';
                    return downloadHelper($html, $name, $request->type);
                case $request->type == 'demand_letter':
                    $html = view('admin.pdflayouts.demand_letter', compact('candidate'))->render();
                    $name = 'DEMAND_LETTER.pdf';
                    return downloadHelper($html, $name);
                default:
                    return redirect()->back()->with('error', 'Invalid PDF action type.');
            }
        } catch (Exception $e) {
            Log::error('PDF generation failed', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'method'  => __METHOD__,
            ]);
            $message = 'PDF generation failed: ' . $e->getMessage();
            Log::error($message);
            return redirect()->back()->with('error', 'PDF generation failed!');
        }
    }
}
