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

    public function compileScss($scssFile,$format) {
        $file = file_get_contents($scssFile);

        $scss = new Compiler();
        if($format=='expanded') {
            $scss->setFormatter('Leafo\ScssPhp\Formatter\Expanded');
        } else if($format=='nested') {
            $scss->setFormatter('Leafo\ScssPhp\Formatter\Nested');
        } else if($format=='compact') {
            $scss->setFormatter('Leafo\ScssPhp\Formatter\Compact');
        } else if($format=='crunched') {
            $scss->setFormatter('Leafo\ScssPhp\Formatter\Crunched');
        } else {
            $scss->setFormatter('Leafo\ScssPhp\Formatter\Compressed');
        }
        $importPath = $this->getImportPaths($scssFile);
        $scss->setImportPaths($importPath);
        $scss = $scss->compile($file);
        return $scss;
    }

    public function getImportPaths($scssFile) {
        $serverPath = constant('FLOW_PATH_ROOT');
        $realPath = dirname($scssFile);
        $realPath = str_replace('resource://','', $realPath);
        $part1 = substr($realPath, 0, strpos($realPath, '/'));
        $part2 = str_replace($part1,'', $realPath);
        $realPath1 = $serverPath.'Packages/Application/'.$part1.'/Resources'.$part2;
        $realPath2 = $serverPath.'Packages/Plugins/'.$part1.'/Resources'.$part2;
        $realPath3 = $serverPath.'Packages/Sites/'.$part1.'/Resources'.$part2;
        $result = array($realPath1,$realPath2,$realPath3);
        return $result;
    }

}
