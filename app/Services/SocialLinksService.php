<?php

namespace App\Services;

use App\Models\SocialLink;

class SocialLinksService
{
    /**
     * Get all social links
     *
     * @return array
     */
    public function getAll()
    {
        return SocialLink::get()
            ->toArray();
    }

    /**
     * Update urls for social links
     *
     * @param $socialLinks
     */
    public function update($socialLinks)
    {
        foreach ($socialLinks as $socialLink) {
            SocialLink::updateOrCreate(
                [
                    'alias' => $socialLink['alias']
                ],
                [
                    'link' => $socialLink['link'],
                ]
            );
        }
    }
}