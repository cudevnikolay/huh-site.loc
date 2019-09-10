<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\SettingsService;
use App\Http\Requests\Admin\ContactInfoRequest;
use \EasySVG;

class SettingsController extends Controller
{
    private $service;
    
    /**
     * SettingsController constructor.
     * @param $service
     */
    public function __construct(SettingsService $service)
    {
        $this->service = $service;
    }
    /**
     * Show settings page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function contactInfo()
    {
        $settings = $this->service->getAllSetting();
        $settingsList = [
            'phone' => $settings['phone'],
            'email' => $settings['email'],
            'address_french' => $settings['address_french'],
            'address_germany' => $settings['address_germany'],
            'worked_time' => $settings['worked_time'],
        ];

        return view('admin.settings.contact-info', compact('settingsList' ));
    }
    
    /**
     * Update contact info
     *
     * @param ContactInfoRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updetaCntactInfo(ContactInfoRequest $request)
    {
        $data = $request->except('_token');
        
        try {
            foreach ($data as $key=> $value) {
                $this->service->setSetting($key, $value);
            }

            return redirect()->back()->with(
                'notifications',
                ['type' => 'success', 'message' => 'Contact info saved']
            );
        } catch(\Exception $e) {
            report($e);
            
            return redirect()->back()->with(
                'notifications',
                ['type' => 'error', 'message' => 'Contact info edit error']
            );
        }
    }
}