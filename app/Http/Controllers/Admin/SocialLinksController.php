<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SocialFormRequest;
use App\Services\SocialLinksService;


class SocialLinksController extends Controller
{
    private $socialLinksService;
    
    public function __construct(SocialLinksService $socialLinksService)
    {
        $this->socialLinksService = $socialLinksService;
    }
    
    /**
     * Show all social links for edit
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('admin.social-links.update')->with([
            'socialLinks' => $this->socialLinksService->getAll(),
        ]);
    }
    
    /**
     * Update social links data
     *
     * @param SocialFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(SocialFormRequest $request)
    {
        $data = $request->except('_token');
        
        try {
            $this->socialLinksService->update($data);
            
            return redirect()->back()->with(
                'notifications',
                ['type' => 'success', 'message' => 'Social links saved']
            );
        } catch(\Exception $e) {
            report($e);
            
            return redirect()->back()->with(
                'notifications',
                ['type' => 'error', 'message' => 'Social links edit error']
            );
        }
    }
}