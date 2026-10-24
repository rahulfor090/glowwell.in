$pages = @('who.php', 'patent.php', 'trademark.php', 'Copyright.php', 'Designs.php', 'Geographical.php', 'enquiry.php')
foreach ($p in $pages) {
    $out = "live_" + $p.Replace('.php', '') + ".html"
    Write-Host "Fetching $p -> $out..."
    curl.exe -s --max-time 45 "https://glowwell.in/$p" -o $out
    if (Test-Path $out) {
        $size = (Get-Item $out).Length
        Write-Host "Done: $out ($size bytes)"
    }
}

# Also download images / assets
$assets = @(
    'images/logo_g.png',
    'images/logo_s.png',
    'images/11_1.png',
    'images/world_trans.png',
    'favicon/favicon-32x32.png',
    'favicon/favicon-96x96.png'
)
New-Item -ItemType Directory -Force -Path "live_assets" | Out-Null
foreach ($a in $assets) {
    $fileName = Split-Path $a -Leaf
    Write-Host "Fetching $a -> live_assets/$fileName"
    curl.exe -s --max-time 30 "https://glowwell.in/$a" -o "live_assets/$fileName"
}
