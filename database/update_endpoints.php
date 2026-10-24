<?php
$files = [
    'patent.php' => 'patent',
    'trademark.php' => 'trademark',
    'copyright.php' => 'copyright',
    'designs.php' => 'designs',
    'geographical.php' => 'geographical',
    'iso-certification.php' => 'iso-certification',
    'company-registration.php' => 'company-registration',
    'cyber-law.php' => 'cyber-law',
    'litigation.php' => 'litigation'
];

foreach ($files as $file => $slug) {
    $code = "<?php\n\$service_slug = '{$slug}';\nrequire __DIR__ . '/service.php';\n";
    file_put_contents(__DIR__ . '/../' . $file, $code);
    echo "Updated $file to dynamic delegate for slug: $slug\n";
}
echo "All 9 service endpoint files now cleanly delegate to dynamic service.php!\n";
