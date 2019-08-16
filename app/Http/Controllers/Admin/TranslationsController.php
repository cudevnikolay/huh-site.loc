<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\LanguageRequest;
use App\Services\TranslationService;
use App\ValueObjects\Admin\Translations\{LanguageValueObject, TranslationValueObject};
use Illuminate\Http\Request;

class TranslationsController extends Controller
{
    private $service;

    /**
     * LanguagesController constructor.
     * @param $service
     */
    public function __construct(TranslationService $service)
    {
        $this->service = $service;

        $this->middleware('auth');
    }

    /**
     * Show languages table
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.translations.index');
    }

    /**
     * Edit language by locale
     *
     * @param string $locale
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(string $locale)
    {
        $data = $this->service->getLanguageByLocale($locale);

        return view('admin.translations.edit', compact('data'));
    }

    /**
     * Save language changes by locale
     *
     * @param LanguageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(LanguageRequest $request)
    {
        $languageValueObj = $this->getDataForValueObj($request, 'edit');
        $routePrevious = url()->previous();

        try {
            $language = $this->service->update($languageValueObj);
        } catch(\DomainException $e) {
            report($e);

            return redirect()->to($routePrevious)->withInput()->with(['error' => $e->getMessage()]);
        }

        return redirect()->to($routePrevious)
            ->with('notifications', ['type' => 'success', 'message' => 'The language data and translations have been saved']);
    }

    /**
     * Create language
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        $data = ['default' => $this->service->getDefaultTranslations()];

        return view('admin.translations.create', compact('data'));
    }

    /**
     * Store new language
     *
     * @param LanguageRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LanguageRequest $request)
    {
        $languageValueObj = $this->getDataForValueObj($request, 'create');
        $routeTo = route('language.index');
        $routePrevious = url()->previous();

        try {
            $language = $this->service->store($languageValueObj);
        } catch(\Exception $e) {
            report($e);

            return redirect()->to($routePrevious)->withInput()->with(['error' => $e->getMessage()]);
        }
        return redirect()->to($routeTo)
            ->with('notifications', ['type' => 'success', 'message' => 'The language data and translations have been saved']);
    }

    /**
     * Switch language status
     *
     * @param $id
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function switchStatus($id)
    {
        try {
            $language = $this->service->switchLanguageStatus($id);

            return response()->json("Language {$language->name} status changed to {$language->enabled}");
        } catch(\DomainException $e) {

            return response($e->getMessage(), 500);
        }
    }

    /**
     * Delete language
     *
     * @param $locale
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function delete($locale)
    {
        try {
            $name = $this->service->deleteLanguage($locale);

            return response()->json("Language {$name} deleted");
        } catch(\DomainException $e) {

            return response($e->getMessage(), 500);
        }
    }

    /**
     * Prepare value object for service
     *
     * @param $request
     * @return LanguageValueObject
     */
    private function getDataForValueObj($request, $type = 'create'):LanguageValueObject
    {
        $translationObj = [];
        $translations = $request->get('translations');
        foreach ($translations as $group) {
            foreach ($group as $item => $translation) {
                if ($type === 'edit') {
                    if ($translation['text'] || $translation['id']) {
                        $translationObj[] = new TranslationValueObject([
                            'id' => (int)$translation['id'],
                            'text' => $translation['text'] ?? '',
                            'group' => $translation['group'],
                            'item' => $item
                        ]);
                    }
                } else if ($type === 'create') {
                    if ($translation['text']) {
                        $translationObj[] = new TranslationValueObject([
                            'id' => (int)$translation['id'],
                            'text' => $translation['text'] ?? '',
                            'group' => $translation['group'],
                            'item' => $item
                        ]);
                    }
                }
            }
        }
        $languageValueObj = new LanguageValueObject([
            'id' => (int) $request['id'],
            'name' => $request['name'],
            'locale' => $request['locale'],
            'enabled' => isset($request['enabled'])? 1: 0,
            'translations' => $translationObj,
        ]);

        return $languageValueObj;
    }
}