<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use App\Services\TeamService;
use Illuminate\Http\Request;

class TeamApiController extends Controller
{
    private $service;
    
    /**
     * TeamApiController constructor.
     * @param $service
     */
    public function __construct(TeamService $service)
    {
        $this->service = $service;
    }
    
    /**
     * Array for use in a DataTable
     *
     * @param Request $request
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->input('length');
        $start = $request->input('start');
        $order = $request->input('order.0.column');
        $dir = $request->input('order.0.dir');
        $search = $request->input('search.value') ?? null;
        $draw = $request->input('draw');
        
        $result = $this->service->getDataTableData($limit, $start, $order, $dir, $search, $draw);
        
        return response()->json($result);
    }
    
    /**
     * Update value for field "enabled"
     *
     * @param $id
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function switchStatus($id)
    {
        return response()->json($this->service->switchStatus($id));
    }
}