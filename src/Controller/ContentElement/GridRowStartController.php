<?php

declare(strict_types=1);

namespace Hhcom\ContaoProjectBundle\Controller\ContentElement;

use Contao\ContentModel;
use Contao\BackendTemplate;
use Contao\CoreBundle\Controller\ContentElement\AbstractContentElementController;
use Contao\CoreBundle\Twig\FragmentTemplate;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Contao\CoreBundle\Routing\ScopeMatcher;
use Hhcom\ContaoProjectBundle\EventListener\GetContentElementListener;

class GridRowStartController extends AbstractContentElementController
{

    private $scopeMatcher;

    public function __construct( ScopeMatcher $scopeMatcher)
    {
        $this->scopeMatcher = $scopeMatcher;
    }

    protected function getResponse(FragmentTemplate $template, ContentModel $model, Request $request): Response
    {
        if ($this->scopeMatcher->isBackendRequest($request)) {
            $template = new BackendTemplate('be_wildcard');
            $template->wildcard = '### Starts the Grid Start Element ###';
            return $template->getResponse();
        }

        $template->grid_css = GetContentElementListener::removeUnwantetClasses($model->grid_css);
        
        return $template->getResponse();
    }
}