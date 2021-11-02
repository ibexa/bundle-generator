<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

return \Ibexa\CodeStyle\PhpCsFixer\InternalConfigFactory::build()->setFinder(
    PhpCsFixer\Finder::create()
        ->in(__DIR__ . '/src')
        ->in(__DIR__ . '/skeleton/ibexa-ee/src')
        ->in(__DIR__ . '/skeleton/ibexa-ee/tests')
        ->in(__DIR__ . '/skeleton/ibexa-oss/src')
        ->in(__DIR__ . '/skeleton/ibexa-oss/tests')
        ->in(__DIR__ . '/tests')
        ->files()->name('*.php')
);

