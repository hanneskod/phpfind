# PhpFind

[![Packagist Version](https://img.shields.io/packagist/v/hanneskod/phpfind.svg?style=flat-square)](https://packagist.org/packages/hanneskod/phpfind)
[![Dependency Status](https://img.shields.io/gemnasium/hanneskod/phpfind.svg?style=flat-square)](https://gemnasium.com/hanneskod/phpfind)

Command line tool to search for php classes in a directory hierarchy

    Usage:
     phpfind [--not-dir[="..."]] [--file-name[="..."]] [--not-file-name[="..."]] [--contains[="..."]] [--not-contains[="..."]] [--path[="..."]] [--not-path[="..."]] [--size[="..."]] [--modified[="..."]] [--depth[="..."]] [--type[="..."]] [--not-type[="..."]] [--namespace[="..."]] [--not-namespace[="..."]] [--def-name[="..."]] [--not-def-name[="..."]] [--abstract] [--not-abstract] [--final] [--not-final] [--instantiable] [--not-instantiable] [--interface] [--not-interface] [--trait] [--not-trait] [--class] [--not-class] [directory1] ... [directoryN]

    Arguments:
     directory             One or multiple directory(ies) to search (default: current working directory)

    Options:
     --not-dir             Directory to ignore (multiple values allowed)
     --file-name           Select files by name pattern (default: ["*.php"]) (multiple values allowed)
     --not-file-name       Ignore files by name pattern (multiple values allowed)
     --contains            Select files by contents pattern (multiple values allowed)
     --not-contains        Ignore files by contents pattern (multiple values allowed)
     --path                Select files by path pattern (multiple values allowed)
     --not-path            Ignore files by path pattern (multiple values allowed)
     --size                Select files by size
     --modified            Set last modified date
     --depth               Set directory scan depth
     --type                Select php definition by type (multiple values allowed)
     --not-type            Ignore php definition by type (multiple values allowed)
     --namespace           Select php definition by namespace (multiple values allowed)
     --not-namespace       Ignore php definition by namespace (multiple values allowed)
     --def-name            Select php definition by name pattern (multiple values allowed)
     --not-def-name        Ignore php definition by name pattern (multiple values allowed)
     --abstract            Restrict selection to abstract classes
     --not-abstract        Ignore abstract classes
     --final               Restrict selection to final classes
     --not-final           Ignore final classes
     --instantiable        Restrict selection to instantiable classes
     --not-instantiable    Ignore instantiable classes
     --interface           Restrict selection to interfaces
     --not-interface       Ignore interfaces
     --trait               Restrict selection to traits
     --not-trait           Ignore traits
     --class               Restrict selection to classes
     --not-class           Ignore classes
     --help (-h)           Display this help message.
     --quiet (-q)          Do not output any message.
     --verbose (-v|vv|vvv) Increase the verbosity of messages
     --version (-V)        Display this application version.
     --ansi                Force ANSI output.
     --no-ansi             Disable ANSI output.
     --no-interaction (-n) Do not ask any interactive question.


## Installation using composer

Simply add a dependency on `hanneskod/phpfind` to your project's `composer.json`.
If in doubt se the composer [documentation](http://getcomposer.org/).

For a system-wide installation via run:

    composer global require hanneskod/phpfind

Make sure you have `~/.composer/vendor/bin/` in your path.

Credits
-------
PhpFind is covered under the [WTFPL](http://www.wtfpl.net/)

@author Hannes Forsgård (hannes.forsgard@fripost.org)
