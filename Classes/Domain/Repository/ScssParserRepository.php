<?php
namespace NeosRulez\ScssParser\Domain\Repository;

/*
 * This file is part of the NeosRulez.ScssParser package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Persistence\Repository;

/**
 * @Flow\Scope("singleton")
 */
class ScssParserRepository extends Repository
{

    /**
     * @param string $scssFile
     */
    public function compileScss($scssFile) {

    }

}
