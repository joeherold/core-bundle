<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\EventListener\HeaderReplay;

use Contao\CoreBundle\Framework\ContaoFrameworkInterface;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Contao\Environment;
use Terminal42\HeaderReplay\Event\HeaderReplayEvent;

class PageLayoutListener
{
    /**
     * @var ScopeMatcher
     */
    private $scopeMatcher;

    /**
     * @var ContaoFrameworkInterface
     */
    private $framework;

    /**
     * @param ScopeMatcher             $scopeMatcher
     * @param ContaoFrameworkInterface $framework
     */
    public function __construct(ScopeMatcher $scopeMatcher, ContaoFrameworkInterface $framework)
    {
        $this->scopeMatcher = $scopeMatcher;
        $this->framework = $framework;
    }

    /**
     * Adds the "Contao-Page-Layout" header to the replay response based on either the TL_VIEW cookie
     * or the current browser user agent string, so that the reverse proxy gains the ability to vary on
     * it. This is needed so that the reverse proxy generates two entries for the same URL when you are
     * using mobile and desktop page layouts.
     *
     * @param HeaderReplayEvent $event
     */
    public function onReplay(HeaderReplayEvent $event): void
    {
        $request = $event->getRequest();

        if (!$this->scopeMatcher->isFrontendRequest($request)) {
            return;
        }

        if ($request->cookies->has('TL_VIEW')) {
            $mobile = 'mobile' === $request->cookies->get('TL_VIEW');
        } else {
            $this->framework->initialize();

            /** @var Environment $environment */
            $environment = $this->framework->getAdapter(Environment::class);
            $mobile = $environment->get('agent')->mobile;
        }

        $headers = $event->getHeaders();
        $headers->set('Contao-Page-Layout', $mobile ? 'mobile' : 'desktop');
    }
}
