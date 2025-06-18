
Route::get('/testii', function(){
    $ip = \Request::ip();
    $response = Http::get("http://ip-api.com/json/{$ip}");
    $location = $response->json();

    return response()->json([
        'country' => $location['country'] ?? 'Unknown',
        'city' => $location['city'] ?? 'Unknown',
        'region' => $location['regionName'] ?? 'Unknown'
    ]);
});