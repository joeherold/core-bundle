<?php

declare(strict_types=1);

/*
 * This file is part of Contao.
 *
 * Copyright (c) 2005-2018 Leo Feyer
 *
 * @license LGPL-3.0+
 */

namespace Contao\CoreBundle\Tests\HttpKernel\Header;

use Contao\CoreBundle\HttpKernel\Header\NativeHeaderStorage;
use PHPUnit\Framework\TestCase;

class NativeHeaderStorageTest extends TestCase
{
    public function testCanBeInstantiated(): void
    {
        $storage = new NativeHeaderStorage();

        $this->assertInstanceOf('Contao\CoreBundle\HttpKernel\Header\NativeHeaderStorage', $storage);
        $this->assertInstanceOf('Contao\CoreBundle\HttpKernel\Header\HeaderStorageInterface', $storage);
    }
}
