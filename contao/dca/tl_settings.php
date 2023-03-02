<?php


$GLOBALS['TL_DCA']['tl_settings']['palettes']['default'] = str_replace(
    'defaultChmod',
    'defaultChmod;{Regenerate CSS style permanently},cssCacheBuster',
    $GLOBALS['TL_DCA']['tl_settings']['palettes']['default']
);

// Active / Deactivate the cache buster
$GLOBALS['TL_DCA']['tl_settings']['fields']['cssCacheBuster'] = [
    'label' => ['Regenerate CSS permanently','Regenerate the CSS on every page load in the frontend. Deactive this in production mode.'],
    'inputType'               => 'checkbox',
	'eval'                    => array('tl_class'=>'w50')
];

?>