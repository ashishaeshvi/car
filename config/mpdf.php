<?php
 
use Mpdf\Config\ConfigVariables;
use Mpdf\Config\FontVariables;

$defaultConfig = (new ConfigVariables())->getDefaults();
$fontDirs = $defaultConfig['fontDir'];

$defaultFontConfig = (new FontVariables())->getDefaults();
$fontData = $defaultFontConfig['fontdata'];

return [
    'mode' => 'utf-8',
    'format' => 'A4',
    'autoScriptToLang' => true,     // ✅ Detect script language automatically
    'autoLangToFont' => true,       // ✅ Auto switch font per language/script
    'fontDir' => array_merge($fontDirs, [
        public_path('fonts'),
    ]),
    'fontdata' => $fontData + [
        'noto' => [
            'R' => 'NotoSansDevanagari-Regular.ttf', // Hindi
        ],
        'amiri' => [
            'R' => 'Amiri-Regular.ttf',              // Arabic
        ],
    ],
    'default_font' => 'dejavusans', // Or use 'dejavusans' if most of your document is English
    'tempDir' => storage_path('app/mpdf'),
];
