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
    public function includeAction() {
        #$scssFile = $this->request->getInternalArgument('__scssFile');
        #$this->scssParserRepository->compileScss($scssFile);
    }

}
