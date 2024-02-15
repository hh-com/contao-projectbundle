<?php

namespace Hhcom\ContaoProjectBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\ContentElement;
use Contao\ContentModel;
use Contao\StringUtil;
use Contao\System;


class GetContentElementListener
{
    public function __invoke(ContentModel $contentModel, string $buffer, $element): string
    {

        // Backend
        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(
            System::getContainer()->get('request_stack')->getCurrentRequest())) {
            return $this->prepareBackend($contentModel, $buffer, $element);
        } else {
            return $this->prepareFrontend($contentModel, $buffer, $element);
        }

    }

    // Backend
    public function prepareBackend(ContentModel $contentModel, string $buffer, $element) {

        if ($contentModel->add_grid) {
            $style = $this->prepareStyleString($contentModel);
            $classstring = $style['string'].' '.$contentModel->type;
        } else {
            $classstring = "noGrid";
        }
        
        return $buffer.'<span class="begridhelper" data-gridstyle="'.$classstring.'">'.$classstring.'</span>';

    }

    // Frontend
    public function prepareFrontend(ContentModel $contentModel, string $buffer, $element) {
        
        if ($contentModel->invisible) {
            return $buffer;
        }

        // Do not add a container // $contentModel->grid_nocontainer
        if ($contentModel->add_grid == "") {
            return $buffer;
        }

        $style = $this->prepareStyleString($contentModel);

        $return = "";

        if (in_array($contentModel->type, $GLOBALS['dontCreateGrid'])) {

            $return .= $buffer;

        } else {

            $return = '<div class="'.$style['string'].'">';
            $return .= $buffer;
            $return .= '</div>';

        }

        return $return;

        // $buffer = preg_replace('/class="/','class=" test '.trim(
        //     " "
        // ) .' ', $buffer, 1);
    }


    /**
     * prepare the css classes as string for the frontend
     * and as array for the backend
     */
    public function prepareStyleString($contentModel) {

        $arr = [];

        // remove unwanted classes
        $grid_css = self::removeUnwantetClasses($contentModel->grid_css);
        if ($grid_css) {
            $tmpClass = implode(" ", array_unique(explode(" ", str_replace("none", "", $grid_css)))) ;
            $arr['grid_css'] = $tmpClass;
           
        } else {
            $tmpClass = "col-12";
            $arr['grid_css'] = $tmpClass;
        }

        // initialisation string
        $gridClassString = "element " . $tmpClass;

        // add Background color 
        if ($contentModel->grid_backgroundcolor) {
            $gridClassString = $gridClassString . " " . $contentModel->grid_backgroundcolor;
            $arr['grid_backgroundcolor'] = $contentModel->grid_backgroundcolor;
        }

        // full width
        if ($contentModel->grid_fullwidth) {
            $gridClassString = $gridClassString . " " . $contentModel->grid_fullwidth;
            $arr['grid_fullwidth'] = $contentModel->grid_fullwidth;
        }

        // space at the bottom
        if ($contentModel->grid_bottomspace) {
            $gridClassString = $gridClassString . " " . $contentModel->grid_bottomspace;
            $arr['grid_bottomspace'] = $contentModel->grid_bottomspace;
        }

        // align the content left/center/right
        if ($contentModel->grid_content_align) {
            if ( $contentModel->grid_content_align != "left") {
                $gridClassString = $gridClassString . " text-".$contentModel->grid_content_align;
                $arr['grid_content_align'] = $contentModel->grid_content_align;
            }
        }

        // no margin around
        if ($contentModel->grid_marginless) {
            $gridClassString = $gridClassString . " is-marginless";
            $arr['grid_marginless'] = "is-marginless";
        }

        // no padding around
        if ($contentModel->grid_paddingless) {
            $gridClassString = $gridClassString . " is-paddingless";
            $arr['grid_paddingless'] = "is-paddingless";
        }

        return [
            'string' => $gridClassString,
            'array' => $arr,
        ];

    }

    // Remove unwanted classes from the grid_css field
    public static function removeUnwantetClasses($grid_css, $alsoRemove = [])
    {
        $unwanted = ['offset-left-0-md','offset-left-0-lg','offset-right-0-md','offset-right-0-lg','offset-left-0','offset-right-0'];
        $toRemove = array_merge($unwanted, $alsoRemove);

        $grid_css  = trim(str_replace($toRemove, '', $grid_css));

        return $grid_css;
    }
}
?>