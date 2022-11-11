<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExportProxyRequest;
use App\Http\Resources\ProxyResource;
use App\Models\Proxy;
use App\Services\ProxyService;

class ProxyController extends Controller
{
    /**
     * Initialization controller
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        return ProxyResource::collection(Proxy::all());
    }

    /**
     * Export resource in CSV file.
     *
     * @param  \App\Http\Requests\ExportProxyRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function export(ExportProxyRequest $request)
    {
        $list = ProxyService::normalizationData($request->format);

        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',
            'Content-type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename=galleries.csv',
            'Expires'             => '0',
            'Pragma'              => 'public'
        ];

        $callback = function() use ($list) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $list, ";");
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
