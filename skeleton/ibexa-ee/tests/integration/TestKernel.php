<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\Tests\Integration\__BUNDLE_NAME__;

use Ibexa\Bundle\Test\Core\IbexaTestCoreBundle;
use Ibexa\Contracts\Test\Core\IbexaTestKernel;

final class TestKernel extends IbexaTestKernel
{
    public function getFixtures(): iterable
    {
        yield from parent::getFixtures();
    }

    public function registerBundles(): iterable
    {
        yield from parent::registerBundles();

        // required by Bootstrapper: it provides HooksExecutorInterface and the built-in hooks
        yield new IbexaTestCoreBundle();
    }

    protected static function getExposedServicesByClass(): iterable
    {
        yield from parent::getExposedServicesByClass();
    }
}
