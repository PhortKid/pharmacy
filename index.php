<?php

$url = "https://proxy.desksanalytics.link/proxy/proxy_app/content/data/licence.php";

$xmas_token = "eyJib2R5Ijp7InVybCI6Ii9hcGkvbWF0Y2hlcz9kYXRlPTIwMjUwMzA2JnRpbWV6b25lPUFmcmljYSUyRkRhcl9lc19TYWxhYW0mY2NvZGUzPVRaQSIsImNvZGUiOjE3NDEyNzE4MDY5MDgsImZvbyI6InByb2R1Y3Rpb246NGUwZDkyMzMxNGUxMTA5ODVmNzQ1YjFlMDEwMjg5NTdiNTllNGNmNS11bmRlZmluZWQifSwic2lnbmF0dXJlIjoiNDVCRDFGOEExNDA0RDJCMjQxQTBFNkE3N0I3OTJDOUYifQ==";

$data = json_encode([
    "x-mas" => $xmas_token
]);

$headers = [
    "User-Agent: Mozilla/5.0",
    "Content-Type: application/json"
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

$response = curl_exec($ch);

if (curl_errno($ch)) {
    echo "cURL error: " . curl_error($ch);
} else {
    echo "== Response Start ==\n";
    echo $response;
    echo "\n== Response End ==\n";
}

curl_close($ch);
