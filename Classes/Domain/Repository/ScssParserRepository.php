<?php
namespace NeosRulez\ScssParser\Domain\Repository;

/*
 * This file is part of the NeosRulez.ScssParser package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;
use Leafo\ScssPhp\Compiler;
use Leafo\ScssPhp\Formatter\Compressed;

/**
 * @Flow\Scope("singleton")
 */
class ScssParserRepository extends Repository
{

    public function compileScss($scssFile) {
        $file = file_get_contents($scssFile);
        $scss = new Compiler();
        $scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');
        $scss = $scss->compile($file);
        return $scss;
    }

}
