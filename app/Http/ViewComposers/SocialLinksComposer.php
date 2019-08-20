<?php

namespace App\Http\ViewComposers;

use App\Services\SocialLinksService;
use Illuminate\View\View;

class SocialLinksComposer
{

    /**
     * @var SocialLinksService
     */
    private $socialLinksService;

    public function __construct(SocialLinksService $socialLinksService)
    {
        $this->socialLinksService = $socialLinksService;

    }

    public function compose(View $view)
    {
        $view->with('socialLinks', $this->socialLinksService->getAll());
    }
}
