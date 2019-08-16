<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Services\TranslationService;
use Illuminate\Http\Request;

class TranslationsApiController extends Controller
{
    private $service;

    /**
     * TranslationsApiController constructor.
     * @param $service
     */
    public function __construct(TranslationService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value') ?? null;
        $draw = $request->input('draw');

        $result = $this->service->getLanguagesForDataTable($limit, $start, $order, $dir, $search, $draw);

        return response()->json($result);
    }
}