<?php

/**
 * @copyright Copyright (C) Ibexa AS. All rights reserved.
 * @license For full copyright and license information view LICENSE file distributed with this source code.
 */
declare(strict_types=1);

namespace Ibexa\BundleGenerator\Command;

use Ibexa\BundleGenerator\Generator\BundleGenerator;
use Ibexa\BundleGenerator\Generator\BundleGeneratorConfiguration;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Helper\QuestionHelper;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\Question;

final class GenerateBundleCommand extends Command
{
    protected function configure(): void
    {
        $this->setName('generate-bundle');

        $this->addArgument(
            'package-name',
            InputArgument::OPTIONAL,
            'Package name e.g page-builder'
        );

        $this->addArgument(
            'target-dir',
            InputArgument::OPTIONAL,
            'Target directory',
            'target'
        );

        $this->addOption(
            'vendor-name',
            null,
            InputOption::VALUE_REQUIRED,
            'Package vendor name e.g. ibexa'
        );

        $this->addOption(
            'vendor-namespace',
            null,
            InputOption::VALUE_REQUIRED,
            'e.g. Ibexa'
        );

        $this->addOption(
            'bundle-name',
            null,
            InputOption::VALUE_REQUIRED,
            'e.g. IbexaPageBuilder'
        );

        $this->addOption(
            'skeleton-name',
            null,
            InputOption::VALUE_OPTIONAL,
            'Skeleton name'
        );
    }

    protected function interact(
        InputInterface $input,
        OutputInterface $output
    ): void {
        /** @var QuestionHelper $helper */
        $helper = $this->getHelper('question');

        $packageName = $this->getNullableStringArgument($input, 'package-name');
        if (empty($packageName)) {
            $defaultPackageName = BundleGenerator::getDefaultPackageName();

            $question = new Question(
                "Package name e.g ibexa-page-builder [$defaultPackageName]: ",
                $defaultPackageName
            );

            $input->setArgument('package-name', $this->getNullableStringAnswer(
                $helper->ask($input, $output, $question),
                'package-name'
            ));
        }

        $vendorName = $this->getNullableStringOption($input, 'vendor-name');
        if (empty($vendorName)) {
            $defaultVendorName = BundleGenerator::getDefaultVendorName();

            $question = new Question(
                'Package vendor name e.g ibexa [' . ($defaultVendorName ?? 'n/a') . ']: ',
                $defaultVendorName
            );

            $vendorName = $this->getNullableStringAnswer(
                $helper->ask($input, $output, $question),
                'vendor-name'
            );
            $input->setOption('vendor-name', $vendorName);
        }

        if ($this->getNullableStringOption($input, 'vendor-namespace') === null) {
            $defaultVendorNamespace = BundleGenerator::getDefaultVendorNamespace($vendorName);

            $question = new Question(
                'Bundle vendor namespace e.g Ibexa [' . ($defaultVendorNamespace ?? 'n/a') . ']: ',
                $defaultVendorNamespace
            );

            $input->setOption('vendor-namespace', $this->getNullableStringAnswer(
                $helper->ask($input, $output, $question),
                'vendor-namespace'
            ));
        }

        if ($this->getNullableStringOption($input, 'bundle-name') === null) {
            $defaultBundleName = BundleGenerator::getDefaultBundleName($packageName);

            $question = new Question(
                "Bundle name without 'Bundle' suffix e.g IbexaPageBuilder [" . ($defaultBundleName ?? 'n/a') . ']: ',
                $defaultBundleName
            );

            $input->setOption('bundle-name', $this->getNullableStringAnswer(
                $helper->ask($input, $output, $question),
                'bundle-name'
            ));
        }
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int {
        $config = new BundleGeneratorConfiguration();
        $config->setTargetDir($this->getNullableStringArgument($input, 'target-dir'));
        $config->setPackageName($this->getNullableStringArgument($input, 'package-name'));
        $config->setSkeletonName($this->getNullableStringOption($input, 'skeleton-name'));
        $config->setVendorName($this->getNullableStringOption($input, 'vendor-name'));
        $config->setVendorNamespace($this->getNullableStringOption($input, 'vendor-namespace'));
        $config->setBundleName($this->getNullableStringOption($input, 'bundle-name'));

        $generator = new BundleGenerator();
        $generator->generate($config);

        return self::SUCCESS;
    }

    private function getNullableStringArgument(
        InputInterface $input,
        string $name
    ): ?string {
        return $this->getNullableStringValue($input->getArgument($name), sprintf('Argument "%s"', $name));
    }

    private function getNullableStringOption(
        InputInterface $input,
        string $name
    ): ?string {
        return $this->getNullableStringValue($input->getOption($name), sprintf('Option "%s"', $name));
    }

    private function getNullableStringAnswer(
        mixed $value,
        string $name
    ): ?string {
        return $this->getNullableStringValue($value, sprintf('Question "%s"', $name));
    }

    private function getNullableStringValue(
        mixed $value,
        string $source
    ): ?string {
        if (is_string($value) || $value === null) {
            return $value;
        }

        throw new InvalidArgumentException(sprintf('%s must be a string or null.', $source));
    }
}
