@php
$copyrightText = getWebsiteSetting('copyright_text') ? trim(getWebsiteSetting('copyright_text')) : 'Copyright ©';
$footerDescription = getWebsiteSetting('footer_description') ? trim(getWebsiteSetting('footer_description')) : 'All
rights reserved.';
$currentYear = date('Y');
@endphp
<footer class="main-footer">
    <strong>
        {{ "{$copyrightText} {$currentYear} {$footerDescription}" }}
    </strong>
</footer>