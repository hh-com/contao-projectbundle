<?php
// src/EventListener/GetContentElementListener.php
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
        

         #return $buffer;
        //  if ($contentModel->invisible) {
        //     return $buffer;
        // }

        // // Do not add a container // $contentModel->grid_nocontainer
        // if ($contentModel->grid_nocontainer) {
        //     return $buffer;
        // }


        $style = $this->prepareStyleString($contentModel);
        $classstring = $style['string'].' '.$contentModel->type;
        #return $buffer;
        return $buffer.'<span class="begridhelper" data-gridstyle="'.$classstring.'">'.$classstring.'</span>';


        echo '<pre>';
        var_dump($buffer);
        exit;
        
        if (strpos($modifiedCssID[1], 'col-') !== false) {
            return $buffer.'<span class="begridhelper" '.$addLineBreakBe.' data-gridstyle="'.trim($modifiedCssID[1]).'">'.trim($modifiedCssID[1]).'</span>';
        } else {
            return $buffer.'<span class="begridhelper" '.$addLineBreakBe.' data-gridstyle="col-12">kein CSS Style</span>';
        }

        return $buffer;
    }

    // Frontend
    public function prepareFrontend(ContentModel $contentModel, string $buffer, $element) {
        
        $dontCreateContainerOn = ['grid_row_start', 'grid_row_end'];

        #return $buffer;
        if ($contentModel->invisible) {
            return $buffer;
        }

        // Do not add a container // $contentModel->grid_nocontainer
        if ($contentModel->add_grid == "") {
            return $buffer;
        }

        $style = $this->prepareStyleString($contentModel);

        

        $return = "";

        if (in_array($contentModel->type, $dontCreateContainerOn)) {

            $return .= $buffer;

        } else {

            $return = '<div class="'.$style['string'].'">';
            $return .= $buffer;
            $return .= '</div>';

        }

        return $return;

        // $buffer = preg_replace('/class="/','class=" ffff '.trim(
        //     " " .$outerCss
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


    public function oldInvoke(ContentModel $contentModel, string $buffer, $element): string
    {
      

       
        return $buffer;
        // Backend
        $addLineBreakBe = '';

        // Frontend
        $createInnerContainer = false;
        $addLineBreakFE = '';
        $fullWidthFE = '';
        $bgcolor = '';
        $contentAlign = '';
        $elementAlign = ''; 


        // Todo:
        //$contentModel->noContainer around $buffer
       

        // Grid Classes entered in the grid_css field
        $modifiedCssID[1] = "col";
        if ($contentModel->grid_css) {
            $modifiedCssID[1] = implode(" ", array_unique(explode(" ", str_replace("none", "", $contentModel->grid_css))));
        }
        
        // Create a line break
        if ($contentModel->grid_linebreak) {
            $addLineBreakBe = 'data-linebreak="true"';
            $addLineBreakFE = '<div class="linebreak col-12" aria-hidden="true"></div>';
        }

        if ($contentModel->grid_backgroundcolor) {
            $bgcolor = " ".$contentModel->grid_backgroundcolor;
        }

        if ($contentModel->grid_content_align) {
            if ( $contentModel->grid_content_align != "left") {
                $contentAlign = " content-".$contentModel->grid_content_align;
            }
        }

        if ($contentModel->grid_element_align) {
            $elementAlign = " is-center";
        }
        

        if ($contentModel->grid_fullwidth) {
            
            if ($contentModel->grid_fullwidth == "content100") {
                #$modifiedCssID[1] = "";
                $fullWidthFE = " fullwidth";
                $createInnerContainer = true;
            }
            if ($contentModel->grid_fullwidth == "content100padding") {
                #$modifiedCssID[1] = "";
                $fullWidthFE = " fullwidthpadding";
                $createInnerContainer = true;
            }
            if ($contentModel->grid_fullwidth == "bgcolor100") {
                $fullWidthFE = " fullwidthbg";
            }
        }

        // Testing all 
        if (true) {
            #$modifiedCssID[1] = " col-12 col-6-md col-3-lg ";
            #$fullWidthFE = ' fullwidth';
            #$bgcolor = ' bgcolor2';
            #$contentAlign = ' content-center';
        }

        
       

        // Backend
        if (System::getContainer()->get('contao.routing.scope_matcher')->isBackendRequest(
            System::getContainer()->get('request_stack')->getCurrentRequest())) {

              
            #$replaceWith = 'data-gridstyle="'.trim($modifiedCssID[1]).'" '.$addLineBreakBe.' class=" begridhelper ';

            if (strpos($modifiedCssID[1], 'col-') !== false) {
                return $buffer.'<span class="begridhelper" '.$addLineBreakBe.' data-gridstyle="'.trim($modifiedCssID[1]).'">'.trim($modifiedCssID[1]).'</span>';
            } else {
                return $buffer.'<span class="begridhelper" '.$addLineBreakBe.' data-gridstyle="col-12">kein CSS Style</span>';
            }
            

        } else { // Frontend

            if ($createInnerContainer == true) {

                $strBuffer = preg_replace('/class="/','class="'.trim( 
                    $fullWidthFE .
                    $bgcolor .
                    $contentAlign 
    
                ) .' ', $buffer, 1);

                $strBuffer = preg_replace('/>/','><div class="fdg '.trim(
                    $modifiedCssID[1] .
                    $elementAlign
                ) .'"> ', $strBuffer, 1)
                . '</div>';


            } else {
                $strBuffer = preg_replace('/class="/','class="'.trim(
                    $modifiedCssID[1] . 
                    $fullWidthFE .
                    $bgcolor .
                    $contentAlign .
                    $elementAlign
    
                ) .' ', $buffer, 1);
            }
           

            return $addLineBreakFE . $strBuffer;

        }
    
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