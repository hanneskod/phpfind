<?php

namespace hanneskod\phpfind\Output;

use Symfony\Component\Console\Output\OutputInterface;
use hanneskod\classtools\Iterator\ClassIterator;

/**
 * Simple enumerated output
 */
class Enum implements \hanneskod\phpfind\Output
{
    /**
     * Simple enumerated output
     *
     * @param  OutputInterface $output
     * @param  ClassIterator   $classIterator
     * @return null
     */
    public function output(OutputInterface $output, ClassIterator $classIterator)
    {
        foreach ($classIterator->getClassMap() as $className => $file) {
            $output->writeln("$file => $className");
        }
    }
}
