<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Framework;

interface ContaoFrameworkInterface extends \Contao\CoreBundle\ContaoFrameworkInterface
{
    /**
     * Checks if the framework has been initialized.
     *
     * @return bool
     */
    public function isInitialized();

    /**
     * Initializes the framework.
     */
    public function initialize();

    /**
     * Creates a new instance of a given class.
     *
     * @param string $class
     * @param array  $args
     *
     * @return object
     */
    public function createInstance($class, $args = []);

    /**
     * Returns an adapter class for a given class.
     *
     * @param string $class
     *
     * @return Adapter
     */
    public function getAdapter($class);
}
