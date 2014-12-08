<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace hanneskod\phpfind;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Finder\Finder;
use hanneskod\classtools\Iterator\ClassIterator;

/**
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class Command extends \Symfony\Component\Console\Command\Command
{
    protected function configure()
    {
        $this
            ->setName('phpfind')
            ->setDescription('Search for php classes in a directory hierarchy')
            ->addArgument(
                'directory',
                InputArgument::OPTIONAL | InputArgument::IS_ARRAY,
                'Directory to search',
                [getcwd()]
            )
            ->addOption(
               'not-dir',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Directory to ignore'
            )
            ->addOption(
               'file-name',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Select files by name pattern',
               ['*.php']
            )
            ->addOption(
               'not-file-name',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Ignore files by name pattern'
            )
            ->addOption(
               'contains',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Select files by contents pattern'
            )
            ->addOption(
               'not-contains',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Ignore files by contents pattern'
            )
            ->addOption(
               'path',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Select files by path pattern'
            )
            ->addOption(
               'not-path',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Ignore files by path pattern'
            )
            ->addOption(
               'size',
               null,
               InputOption::VALUE_OPTIONAL,
               'Select files by size'
            )
            ->addOption(
               'modified',
               null,
               InputOption::VALUE_OPTIONAL,
               'Set last modified date'
            )
            ->addOption(
               'depth',
               null,
               InputOption::VALUE_OPTIONAL,
               'Set directory scan depth'
            )
            ->addOption(
               'type',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Select php definition by type'
            )
            ->addOption(
               'not-type',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Ignore php definition by type'
            )
            ->addOption(
               'namespace',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Select php definition by namespace'
            )
            ->addOption(
               'not-namespace',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Ignore php definition by namespace'
            )
            ->addOption(
               'def-name',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Select php definition by name pattern'
            )
            ->addOption(
               'not-def-name',
               null,
               InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
               'Ignore php definition by name pattern'
            )
            ->addOption(
               'abstract',
               null,
               InputOption::VALUE_NONE,
               'Restrict selection to abstract classes'
            )
            ->addOption(
               'not-abstract',
               null,
               InputOption::VALUE_NONE,
               'Ignore abstract classes'
            )
            ->addOption(
               'final',
               null,
               InputOption::VALUE_NONE,
               'Restrict selection to final classes'
            )
            ->addOption(
               'not-final',
               null,
               InputOption::VALUE_NONE,
               'Ignore final classes'
            )
            ->addOption(
               'instantiable',
               null,
               InputOption::VALUE_NONE,
               'Restrict selection to instantiable classes'
            )
            ->addOption(
               'not-instantiable',
               null,
               InputOption::VALUE_NONE,
               'Ignore instantiable classes'
            )
            ->addOption(
               'interface',
               null,
               InputOption::VALUE_NONE,
               'Restrict selection to interfaces'
            )
            ->addOption(
               'not-interface',
               null,
               InputOption::VALUE_NONE,
               'Ignore interfaces'
            )
            ->addOption(
               'trait',
               null,
               InputOption::VALUE_NONE,
               'Restrict selection to traits'
            )
            ->addOption(
               'not-trait',
               null,
               InputOption::VALUE_NONE,
               'Ignore traits'
            )
            ->addOption(
               'class',
               null,
               InputOption::VALUE_NONE,
               'Restrict selection to classes'
            )
            ->addOption(
               'not-class',
               null,
               InputOption::VALUE_NONE,
               'Ignore classes'
            )
        ;
    }

    /**
     * @param  InputInterface  $input
     * @param  OutputInterface $output
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $this->createOutput($input)->output(
            $output,
            $this->createClassIterator($input)
        );
    }

    /**
     * @param  InputInterface $input
     * @return Output
     */
    public function createOutput(InputInterface $input)
    {
        // TODO create output mode based in cli option
        return new Output\Enum;
    }

    /**
     * @param  InputInterface $input
     * @return ClassIterator
     */
    public function createClassIterator(InputInterface $input)
    {
        $classIterator = new ClassIterator($this->createFinder($input));

        $classIterator->enableAutoloading();

        foreach ($input->getOption('type') as $pattern) {
            $classIterator = $classIterator->type($pattern);
        }

        foreach ($input->getOption('not-type') as $pattern) {
            $classIterator = $classIterator->not(
                $classIterator->type($pattern)
            );
        }

        foreach ($input->getOption('namespace') as $pattern) {
            $classIterator = $classIterator->inNamespace($pattern);
        }

        foreach ($input->getOption('not-namespace') as $pattern) {
            $classIterator = $classIterator->not(
                $classIterator->inNamespace($pattern)
            );
        }

        foreach ($input->getOption('def-name') as $pattern) {
            $classIterator = $classIterator->name($pattern);
        }

        foreach ($input->getOption('not-def-name') as $pattern) {
            $classIterator = $classIterator->not(
                $classIterator->name($pattern)
            );
        }

        if ($input->getOption('abstract')) {
            $classIterator = $classIterator->where('isAbstract');
        }

        if ($input->getOption('not-abstract')) {
            $classIterator = $classIterator->not(
                $classIterator->where('isAbstract')
            );
        }

        if ($input->getOption('final')) {
            $classIterator = $classIterator->where('isFinal');
        }

        if ($input->getOption('not-final')) {
            $classIterator = $classIterator->not(
                $classIterator->where('isFinal')
            );
        }

        if ($input->getOption('instantiable')) {
            $classIterator = $classIterator->where('isInstantiable');
        }

        if ($input->getOption('not-instantiable')) {
            $classIterator = $classIterator->not(
                $classIterator->where('isInstantiable')
            );
        }

        if ($input->getOption('interface')) {
            $classIterator = $classIterator->where('isInterface');
        }

        if ($input->getOption('not-interface')) {
            $classIterator = $classIterator->not(
                $classIterator->where('isInterface')
            );
        }

        if ($input->getOption('trait')) {
            $classIterator = $classIterator->where('isTrait');
        }

        if ($input->getOption('not-trait')) {
            $classIterator = $classIterator->not(
                $classIterator->where('isTrait')
            );
        }

        if ($input->getOption('class')) {
            $classIterator = $classIterator->not(
                $classIterator->where('isTrait')
            )->not(
                $classIterator->where('isInterface')
            );
        }

        if ($input->getOption('not-class')) {
            $classIterator = $classIterator->not(
                $classIterator->not(
                    $classIterator->where('isTrait')
                )->not(
                    $classIterator->where('isInterface')
                )
            );
        }

        return $classIterator;
    }

    /**
     * @param  InputInterface $input
     * @return Finder
     */
    public function createFinder(InputInterface $input)
    {
        $finder = new Finder;

        $finder->files();

        foreach ($input->getArgument('directory') as $dir) {
            $finder->in($dir);
        }

        foreach ($input->getOption('not-dir') as $ignoreDir) {
            $finder->exclude($ignoreDir);
        }

        foreach ($input->getOption('file-name') as $pattern) {
            $finder->name($pattern);
        }

        foreach ($input->getOption('not-file-name') as $pattern) {
            $finder->notName($pattern);
        }

        foreach ($input->getOption('contains') as $pattern) {
            $finder->contains($pattern);
        }

        foreach ($input->getOption('not-contains') as $pattern) {
            $finder->notContains($pattern);
        }

        foreach ($input->getOption('path') as $pattern) {
            $finder->path($pattern);
        }

        foreach ($input->getOption('not-path') as $pattern) {
            $finder->notPath($pattern);
        }

        if ($size = $input->getOption('size')) {
            $finder->size($size);
        }

        if ($modified = $input->getOption('modified')) {
            $finder->date($modified);
        }

        if ($depth = $input->getOption('depth')) {
            $finder->depth($depth);
        }

        return $finder;
    }
}

