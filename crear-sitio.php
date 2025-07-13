<?php

// Obtener parámetros GET
$zap = $_GET['zap'] ?? null;
$subdominio = $_GET['subdominio'] ?? null;

if (!$zap || !$subdominio) {
    die("Error: Faltan parámetros.");
}

// CONFIGURACIONES
$server_id = "325231"; // ID del servidor en RunCloud
$webapp_id = "2454733"; // ID de la Web App plantilla
$api_token = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ3b3Jrc3BhY2VfaWQiOjEwNzM4NSwiZXhwIjpudWxsLCJ1c2VyX2lkIjoxMDcxMzAsInVuaXF1ZV9pZGVudGlmaWVyIjoiMDVmYTMzMzgtZjJhZi00OWI3LTlhMTktMzU1MzdjYTgwMDZiIn0.Za0CC-jD956G8DY6Z7ZNvvx-YOMGYXFBs0qn1HnsdMA";
$domain = "$subdominio.zedlix.com";

// Preparar solicitud a RunCloud
$url = "https://manage.runcloud.io/api/v3/servers/$server_id/webapps/$webapp_id/clone";
$headers = [
    "Authorization: Bearer $api_token",
    "Content-Type: application/json",
    "Accept: application/json",
    "User-Agent: ZedlixCloner/1.0"
];
$data = [
    "destinationName" => $subdominio,
    "domainName" => $domain,
    "isProduction" => true,
    "cloneExistingDatabase" => true
];

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

if ($httpCode === 200 || $httpCode === 201) {
    echo "Sitio clonado con éxito. Redirigiendo a https://$domain ...";
    header("refresh:5;url=https://$domain");
} else {
    echo "Error al clonar sitio en RunCloud: $response";
}
