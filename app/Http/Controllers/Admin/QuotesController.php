<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\QuotesService;
use App\Http\Requests\Admin\QuoteRequest;

class QuotesController extends Controller
{
    private $quotesService;
    
    protected const DS = DIRECTORY_SEPARATOR;
    
    /**
     * QuotesController constructor.
     *
     * @param QuotesService $quotesService
     */
    public function __construct(QuotesService $quotesService)
    {
        $this->quotesService = $quotesService;
    }
    
    /**
     * Show all quotes
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.quotes.index');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.quotes.create');
    }
    
    /**
     * @param QuoteRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(QuoteRequest $request)
    {
        #Preparation of all data
        $dataAll = $request->all();

        # save and redirect
        if (!$this->quotesService->store($dataAll)) {
            return redirect()->route('quotes.create')
                ->withInput()
                ->with('notifications', ['type' => 'error', 'message' => 'Quotes save error']);
        } else {
            return redirect()->route('quotes.index')
                ->with('notifications', ['type' => 'success', 'message' => 'Quotes has been saved']);
        }
    }
    
    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        # get object
        $quote = $this->quotesService->getById($id);
        
        return view('admin.quotes.edit', compact('quote'));
    }
    
    /**
     * Update info and save
     *
     * @param int $id
     * @param QuoteRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update($id, QuoteRequest $request)
    {
        # Preparation of all data
        $dataAll = $request->all();
        # Check enabled/not enabled
        $dataAll['enabled'] = isset($dataAll['enabled']) ? 1 : 0;
        
        # Save and redirect
        if (!$this->quotesService->edit($dataAll)) {
            return redirect()->route('quotes.edit', ['id' => $id])
                ->withInput()
                ->with('notifications', ['type' => 'error', 'message' => 'Quotes save error']);
        } else {
            return redirect()->route('quotes.index')
                ->with('notifications', ['type' => 'success', 'message' => 'Quotes has been saved']);
        }
    }
    
    /**
     * @param $id
     *
     * Delete this field
     */
    public function destroy($id)
    {
        $this->quotesService->delete($id);
    }
}
