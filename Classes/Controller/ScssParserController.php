<?php
namespace NeosRulez\ScssParser\Controller;

/*
 * This file is part of the NeosRulez.ScssParser package.
 */

use Neos\Flow\Annotations as Flow;
use Neos\Flow\Mvc\Controller\ActionController;
use Neos\Eel\FlowQuery\FlowQuery;
use Neos\Eel\FlowQuery\Operations;

class ScssParserController extends ActionController
{

    /**
     * @Flow\Inject
     * @var \NeosRulez\ScssParser\Domain\Factory\ScssParserFactory
     */
    protected $scssParserFactory;

    /**
     * @return void
     * @Flow\SkipCsrfProtection
     */
    public function includeFileAction() {
        $scssFile = $this->request->getInternalArgument('__source');
        $inline = $this->request->getInternalArgument('__inline');
        $format = $this->request->getInternalArgument('__format');
        if($inline == TRUE) {
            $css = $this->scssParserFactory->compileScss($scssFile,$format);
            $this->view->assign('css',$css);
        } else {
            $outputFolder = $this->request->getInternalArgument('__outputFolder');
            $minfile = explode("/", $scssFile);
            $minfile = $minfile[count($minfile)-1];
            $minfile = explode(".", $minfile);
            $minfile = $minfile[0].'.min.css';
            $file = $outputFolder.$minfile;
            $sourceFileTs = filemtime($scssFile);
            if (file_exists($file)) {
                $targetFileTs = filemtime($file);
                if($sourceFileTs>$targetFileTs) {
                    $css = $this->scssParserFactory->compileScss($scssFile,$format);
                    file_put_contents($file, $css);
                }
            } else {
                $css = $this->scssParserFactory->compileScss($scssFile,$format);
                file_put_contents($file, $css);
            }
            $path = explode("/", $file);
            $package = $path[2];
            $filepath = '';
            for($i=3; $i<count($path); $i++) {
                if($i==count($path)-1) {
                    $filepath .= $path[$i];
                } else {
                    if($i!=3) {
                        $filepath .= $path[$i] . '/';
                    }
                }
            }
            $this->view->assign('package',$package);
            $this->view->assign('filepath',$filepath);
        }
    }

}
