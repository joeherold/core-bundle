<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\EventListener;

use Contao\CoreBundle\Routing\ScopeMatcher;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

class RefererIdListener
{
    /**
     * @var CsrfTokenManagerInterface
     */
    private $tokenManager;

    /**
     * @var ScopeMatcher
     */
    private $scopeMatcher;

    /**
     * @var CsrfToken
     */
    private $token;

    /**
     * @param CsrfTokenManagerInterface $tokenManager
     * @param ScopeMatcher              $scopeMatcher
     */
    public function __construct(CsrfTokenManagerInterface $tokenManager, ScopeMatcher $scopeMatcher)
    {
        $this->tokenManager = $tokenManager;
        $this->scopeMatcher = $scopeMatcher;
    }

    /**
     * Adds the referer ID to the request.
     *
     * @param GetResponseEvent $event
     */
    public function onKernelRequest(GetResponseEvent $event): void
    {
        if (!$this->scopeMatcher->isBackendMasterRequest($event)) {
            return;
        }

        $request = $event->getRequest();

        if (null === $this->token) {
            $this->token = $this->tokenManager->refreshToken('contao_referer_id');
        }

        $request->attributes->set('_contao_referer_id', $this->token->getValue());
    }
}
