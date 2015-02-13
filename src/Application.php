<?php

namespace hanneskod\phpfind;

/**
 * Synfony single command application
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
