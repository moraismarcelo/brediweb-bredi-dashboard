<?php
use Illuminate\Support\Facades\File;

// require base_path() . '/Bredi/bredi-dashboard/src/Deploy/index.php';

function loadAssetJs($path){
    $file = File::get($path);
    echo "<script>" . $file . "</script>";
}

function loadAssetCSS($path)
{
    $file = File::get($path);
    echo "<style>" . $file . "</style>";
}

function activeMenu($rota)
{
    if (is_array($rota)) {
        if(count($rota) > 0) {
            foreach($rota as $rotaSingle) {
                if((strpos(\Illuminate\Support\Facades\Route::currentRouteName(), $rotaSingle) === 0)) {
                    return ' active ';
                }
            }
        }
    } else {
        return (strpos(\Illuminate\Support\Facades\Route::currentRouteName(), $rota) === 0) ? ' active ' : '';
    }
}

if (!function_exists('decimalParaPagina')) {
    function decimalParaPagina($valor, $prefixo = null)
    {
        if (isset($valor)) {
            return $prefixo . number_format($valor, 2, ',', '.');
        }
    }
}

if (!function_exists('decimalParaBanco')) {
    function decimalParaBanco($valor)
    {
        return str_replace("R$ ", "", str_replace(",", ".", str_replace(".", "", $valor)));
    }
}

function sendResponse($result, $message, $code = 200)
{
    $response = [
        'success' => true,
        'data'    => $result,
        'message' => $message,
    ];
    
    return response()->json($response, $code);
}

function sendError($error, $code = 404, $errorMessages = [])
{
    $response = [
        'success' => false,
        'message' => $error,
    ];

    if(!empty($errorMessages)){
        $response['data'] = $errorMessages;
    }
    
    return response()->json($response, $code);
}

function checkRequired($input) {
    $config = explode('|',config($input));
    if (in_array('required', $config)) {
        return 'required';
    }
}

function rotasControle($funcao, $customMiddleware = [], $groupPrefix = null){
    $middleware = ['auth', \Brediweb\BrediDashboard\Http\Middleware\ValidaPermissao::class];
    return Route::name($groupPrefix)->prefix(config('bredidashboard.prefix'))->middleware(array_merge($middleware, $customMiddleware))->group($funcao);
}
