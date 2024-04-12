<?php

namespace Hhcom\ContaoProjectBundle\EventListener;

use Contao\CoreBundle\ServiceAnnotation\Hook;
use Contao\ContentElement;
use Contao\ContentModel;
use Contao\StringUtil;
use Contao\System;
use Contao\Form;
use Contao\Input;
use Contao\Widget;

class ParseWidgetListener
{
    public function __invoke(string $buffer, Widget $widget): string
    {
        // Add the row and col class to the form_fields in Backend
        if (Input::get('table') == "tl_form_field" && Input::get('act') != "edit") {

            #$replaceWith = 'data-gridstyle="'.trim($widget->grid_css).'" class=" begridhelper ';
            #$buffer = preg_replace('/class="/', $replaceWith , $buffer, 1);
            $buffer = $buffer . '<span class="begridhelper" data-gridstyle="'.trim($widget->grid_css).'">'.$widget->grid_css.'</span>';
        }

        return $buffer;
    }
}


?>
