<?php

/*
 * Copyright (c) 2024. Encore Digital Group.
 * All Right Reserved.
 */

namespace PHPGenesis\CLI\Commands;

use PHPGenesis\CLI\Commands\CommandTraits\CommonInputs;
use PHPGenesis\CLI\Commands\CommandTraits\ConfigurePrompts;
use PHPGenesis\Common\Composer\Composer;
use PHPGenesis\Common\Config\CommonConfig;
use PHPGenesis\Common\Config\Packages;
use PHPGenesis\Common\Config\PhpGenesisConfig;
use PHPGenesis\Common\Exceptions\MissingConfigurationFileException;
use PHPGenesis\Logger\Config\LoggerConfig;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/** @experimental */
class InstallCommand extends Command
{
    use CommonInputs, ConfigurePrompts;

    const ARG_PACKAGE = 'package';

    public InputInterface $input;
    public OutputInterface $output;

    protected function configure(): void
    {
        $this
            ->setName('install')
            ->addArgument(self::ARG_PACKAGE, null, 'The package to install', 'phpgenesis');
    }

    /**
     * Interact with the user before validating the input.
     */
    protected function interact(InputInterface $input, OutputInterface $output): void
    {
        parent::interact($input, $output);

        $this->input = $input;
        $this->output = $output;

        $this->configurePrompts($input, $output);
    }

    /**
     * Execute the command.
     *
     * @throws MissingConfigurationFileException
     */
    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        if (!file_exists(CommonConfig::basePath('/' . PhpGenesisConfig::FILE_NAME))) {
            file_put_contents(CommonConfig::basePath('/' . PhpGenesisConfig::FILE_NAME), '{}');
        }

        if (Composer::installed(str_enum_val(Packages::Logger), true) && $this->input->getArgument(self::ARG_PACKAGE) === 'logger') {
            LoggerConfig::install();
        }

        return Command::SUCCESS;
    }
}
