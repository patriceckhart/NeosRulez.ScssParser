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
     * @var \NeosRulez\ScssParser\Domain\Repository\ScssParserRepository
     */
    protected $scssParserRepository;

    /**
     * @return void
     */
    public function includeFileAction() {
        $scssFile = $this->request->getInternalArgument('__source');
        $inline = $this->request->getInternalArgument('__inline');
        $css = $this->scssParserRepository->compileScss($scssFile);
        if($inline == TRUE) {
            $this->view->assign('css',$css);
        } else {
            $outputFolder = $this->request->getInternalArgument('__outputFolder');
            $file = $outputFolder.'app.css';
            file_put_contents($file, $css);
            $path = explode("/", $file);
            $package = $path[2];
            
            $filepath = $path[3];
            $this->view->assign('cssFile',$package.'/'.$filepath);
        }
    }

}
