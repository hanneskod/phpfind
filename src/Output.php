<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace hanneskod\phpfind;

use Symfony\Component\Console\Output\OutputInterface;
use hanneskod\classtools\Iterator\ClassIterator;

/**
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
interface Output
{
    /**
     * Output iterator to interface
     *
     * @param  OutputInterface $interface
     * @param  ClassIterator   $classIterator
     * @return void
     */
    public function output(OutputInterface $interface, ClassIterator $classIterator);
}
