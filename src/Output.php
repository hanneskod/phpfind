<?php

namespace hanneskod\phpfind;

use Symfony\Component\Console\Output\OutputInterface;
use hanneskod\classtools\Iterator\ClassIterator;

/**
 * Defines the output interface
 */
interface Output
{
    /**
     * Output iterator
     *
     * @param  OutputInterface $interface
     * @param  ClassIterator   $classIterator
     * @return null
     */
    public function output(OutputInterface $interface, ClassIterator $classIterator);
}
