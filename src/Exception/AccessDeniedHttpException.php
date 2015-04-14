<?php

/**
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2015 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Exception;

use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException as BaseAccessDeniedHttpException;

/**
 * Access denied exception.
 *
 * @author Christian Schiffler <https://github.com/discordier>
 */
class AccessDeniedHttpException extends BaseAccessDeniedHttpException
{
}
