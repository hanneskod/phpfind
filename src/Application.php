<?php
/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace hanneskod\phpfind;

/**
 * Synfony single command application
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class Application extends \Symfony\Component\Console\Application
{
    protected function getCommandName(\Symfony\Component\Console\Input\InputInterface $input)
    {
        return 'phpfind';
    }

    protected function getDefaultCommands()
    {
        return array_merge(
            parent::getDefaultCommands(),
            [new Command]
        );
    }

    public function getDefinition()
    {
        $def = parent::getDefinition();
        $def->setArguments();
        return $def;
    }
}
