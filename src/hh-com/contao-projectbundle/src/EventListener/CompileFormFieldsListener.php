<?php

    namespace Hhcom\ContaoProjectBundle\EventListener;

    use Contao\CoreBundle\ServiceAnnotation\Hook;
    use Contao\ContentElement;
    use Contao\ContentModel;
    use Contao\StringUtil;
    use Contao\System;
    use Contao\Form;

    
    class CompileFormFieldsListener
    {
        public function __invoke(array $fields, string $formId, Form $form): array
        {

            foreach ($fields as $field) {
                if ($field->grid_css) {
                //$field->class adds the grid to each sub element (label, input,..)
                    $field->prefix = trim($field->prefix . " " . $field->grid_css);
                }
            }
            return $fields;
        }
    }
?>