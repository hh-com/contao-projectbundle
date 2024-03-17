<?php

$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace(
    '{meta_legend}',
    '{Header Image},singleSRC,imageSize;{meta_legend}',
    $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']
);


// add singleSRC to tl_page

$GLOBALS['TL_DCA']['tl_page']['fields']['singleSRC'] = [
    'label' => ['Headerbild','Hintergrundbild für die Seite.'],
    'exclude' => true,
    'inputType' => 'fileTree',
    'eval' => ['filesOnly' => true, 'fieldType' => 'radio', 'mandatory' => true, 'tl_class' => 'clr w25'],
    'sql' => "binary(16) NULL",
   
];

$GLOBALS['TL_DCA']['tl_page']['fields']['imageSize'] = [
    'label'                   => ['Größe des Hintergrundbild (richtige Bildgröße hochladen)','Wählen Sie die Größe des Hintergrundbildes. Beachten Sie dass das Bild in der richtigen Größe hochgeladen werden muss.'],       
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => ['_header_3840x1600'=>'3840 x 1600', '_header_3840x800'=>'3840 x 800' ,'_header_3840x600'=> '3840 x 600'],
    'eval'                    => ['tl_class'=>'w25','includeBlankOption'=>true],
    'sql'                     => "varchar(32) NOT NULL default '_header_3840x800'"
]; 


?>