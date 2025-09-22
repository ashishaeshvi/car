<?php

use App\Models\WebsiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Mpdf\Mpdf;

use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;


if (!function_exists('getWebsiteSetting')) {
    function getWebsiteSetting($key = null)
    {
        $settings = WebsiteSetting::first();
        if (!$settings)
            return null;
        return $key ? $settings->$key ?? null : $settings;
    }
}

/*
 * ------------------------------------------------------------------------
 * Convert a date from dd-mm-yyyy (e.g., 25-12-2025) to yyyy-mm-dd (e.g., 2025-12-25)
 * ------------------------------------------------------------------------
 * @param string $date The input date string
 * @param string $inputFormat The format of the input date (default: 'd-m-Y')
 * @param string $outputFormat The desired output format (default: 'Y-m-d')
 * @return string The formatted date or null on failure
 */

if (!function_exists('convertDateFormat')) {
    function convertDateFormat($date, $inputFormat = 'd-m-Y', $outputFormat = 'Y-m-d')
    {
        try {
            $dateTime = DateTime::createFromFormat($inputFormat, $date);

            // Check if parsing was successful
            if ($dateTime === false) {
                Log::error("convertDateFormat: Failed to parse date '{$date}' with format '{$inputFormat}'");
                throw new Exception('Invalid date format');
            }

            return $dateTime->format($outputFormat);
        } catch (Exception $e) {
            Log::error('convertDateFormat Exception: ' . $e->getMessage());
            return null;
        }
    }
}


if (!function_exists('uploadFiles')) {
    function uploadFiles(Request $request, $param, $folder)
    {
        $imageNameArr = [];
        if ($request->hasFile($param)) {
            Storage::disk('public')->exists($folder) || Storage::disk('public')->makeDirectory($folder);
            if (is_array($request->file($param))) {
                foreach ($request->file($param) as $file) {
                    $imageName = Storage::disk('public')->putFile($folder, $file);
                    array_push($imageNameArr, $imageName);
                }
            } else {
                $imageName = Storage::disk('public')->putFile($folder, $request->file($param));
                array_push($imageNameArr, $imageName);
            }
        }
        return implode(',', $imageNameArr);
    }
}

if (!function_exists('uploadWebpImage')) {
    function uploadWebpImage($files, string $folder = 'images', bool $multiple = false, $oldFile = null, int $quality = 90)
    {
        if (!$multiple) {
            // Delete old file if exists
            if ($oldFile && Storage::disk('public')->exists($oldFile)) {
                Storage::disk('public')->delete($oldFile);
            }

            $filename = Str::uuid() . '.webp';
            
            // For Intervention Image v2 (most compatible)
            $image = Image::make($files)->encode('webp', $quality);
            
            Storage::disk('public')->put("{$folder}/{$filename}", (string) $image);

            return "{$folder}/{$filename}";
        } else {
            // Multiple files
            $paths = [];
            foreach ($files as $file) {
                $filename = Str::uuid() . '.webp';
                
                $image = Image::make($file)->encode('webp', $quality);
                
                Storage::disk('public')->put("{$folder}/{$filename}", (string) $image);
                $paths[] = "{$folder}/{$filename}";
            }
            return $paths;
        }
    }
}
if (!function_exists('deleteFiles')) {
    function deleteFiles($fileName)
    {
        try {
            $fileNameArr = is_array($fileName) ? $fileName : explode(',', $fileName);

            foreach ($fileNameArr as $file) {
                if (Storage::disk('public')->exists($file)) {
                    Storage::disk('public')->delete($file);
                }
            }
        } catch (\Exception $e) {
            return 'Unable to delete files.';
        }
    }
}

/**
 * ------------------------------------------------------------------------
 * Display Image
 * ------------------------------------------------------------------------
 * @return string
 */

if (!function_exists('displayImage')) {
    function displayImage($path)
    {
        if ($path && (Storage::disk('public')->exists($path) || file_exists(public_path($path)))) {
            $url = URL::to(Storage::url($path));
            return $url;
        } else {
            $path = URL::to('images/noimage.jpg');
            return $path;
        }
    }
}

/**
 * ------------------------------------------------------------------------
 * Download Pdf
 * ------------------------------------------------------------------------
 * @return string
 */

if (!function_exists('downloadHelper')) {
    function downloadHelper($html, $name, $type = NULL, $download = true)
    {
        $baseConfig = config('mpdf');
        $zeroMargins = [
            'margin_top'    => 0,
            'margin_bottom' => 0,
            'margin_left'   => 0,
            'margin_right'  => 0,
        ];
        $config = ($type === 'affidavit' || $type === 'scan' || $type == 'agreement_OMAN' || $type == 'agreement_QATAR') ? array_merge($baseConfig, $zeroMargins) : $baseConfig;
        $mpdf = new Mpdf($config);
        $mpdf->WriteHTML($html);
        
        $pdfContent = $mpdf->Output($name, 'S');

        return response($pdfContent)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', ($download ? 'attachment' : 'inline') . '; filename="' . $name . '"');
    }
}

if (!function_exists('dynamicPhoneNo')) {
    function dynamicPhoneNo($countryCode, $fe_no)
    {
        return match ($countryCode) {
            '+973' => "5545{$fe_no}",
            '+965' => "5545{$fe_no}",
            '+968' => "5545{$fe_no}",
            '+974' => "5545{$fe_no}",
            '+966' => "5545{$fe_no}",
            '+971' => "5545{$fe_no}",
        };
    }
}


