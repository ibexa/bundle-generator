<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\BundleGenerator\Composer;

use Composer\IO\IOInterface;
use Composer\Script\Event;
use Ibexa\BundleGenerator\Generator\BundleGenerator;
use Ibexa\BundleGenerator\Generator\BundleGeneratorConfiguration;
use InvalidArgumentException;

final class ScriptHandler
{
    public static function generate(Event $event): void
    {
        $io = $event->getIO();

        $config = new BundleGeneratorConfiguration();
        $config->setSkeletonName(self::askForSkeletonName($io));
        $config->setPackageName(self::askForPackageName($io));
        $config->setVendorName(self::askForVendorName($io));
        $config->setVendorNamespace(self::askForVendorNamespace($io, $config));
        $config->setBundleName(self::askForBundleName($io, $config));
        $config->setTargetDir(self::getCurrentDirectory());

        $generator = new BundleGenerator();
        $generator->generate($config);
    }

    private static function askForPackageName(IOInterface $io): string
    {
        $defaultPackageName = BundleGenerator::getDefaultPackageName();

        return self::getStringValue($io->ask(
            "Package name e.g ibexa-page-builder [$defaultPackageName]: ",
            $defaultPackageName
        ), 'Package name');
    }

    private static function askForVendorName(IOInterface $io): string
    {
        $defaultVendorName = BundleGenerator::getDefaultVendorName();

        return self::getStringValue($io->ask(
            'Package vendor name e.g ibexa [' . ($defaultVendorName ?? 'n/a') . ']: ',
            $defaultVendorName
        ), 'Vendor name');
    }

    private static function askForVendorNamespace(
        IOInterface $io,
        BundleGeneratorConfiguration $config
    ): string {
        $defaultVendorNamespace = BundleGenerator::getDefaultVendorNamespace($config->getVendorName());

        return self::getStringValue($io->ask(
            'Bundle vendor namespace e.g Ibexa [' . ($defaultVendorNamespace ?? 'n/a') . ']: ',
            $defaultVendorNamespace
        ), 'Vendor namespace');
    }

    private static function askForBundleName(
        IOInterface $io,
        BundleGeneratorConfiguration $config
    ): string {
        $defaultBundleName = BundleGenerator::getDefaultBundleName($config->getPackageName());

        return self::getStringValue($io->ask(
            "Bundle name without 'Bundle' suffix e.g IbexaPageBuilder [" . ($defaultBundleName ?? 'n/a') . ']: ',
            $defaultBundleName
        ), 'Bundle name');
    }

    private static function askForSkeletonName(IOInterface $io): string
    {
        $skeletons = BundleGenerator::getAvailableSkeletons();
        if (count($skeletons) === 1) {
            return self::getStringValue(reset($skeletons), 'Skeleton');
        }

        return self::getStringValue($io->select(
            'Skeleton',
            array_combine($skeletons, $skeletons),
            BundleGenerator::DEFAULT_SKELETON_NAME
        ), 'Skeleton');
    }

    private static function getStringValue(
        mixed $value,
        string $source
    ): string {
        if (is_string($value)) {
            return $value;
        }

        throw new InvalidArgumentException(sprintf('%s must be a string.', $source));
    }

    private static function getCurrentDirectory(): string
    {
        return self::getStringValue(realpath('.'), 'Current directory');
    }
}
