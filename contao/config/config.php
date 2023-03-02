<?php

    /**
     * Grid Layout from https://jenil.github.io/chota/#!
     */

    $GLOBALS['gridColumnsCount'] = 12;
    
    $gridMobile['col'] = 'col';
    $gridTablet['col'] = 'col';
    $gridDesktop['col'] = 'col';

    for ($i = $GLOBALS['gridColumnsCount']; $i >= 1 ; $i--) {
        $gridMobile['col-' . $i] = 'col-' . $i;
        $gridTablet['col-' . $i . '-md'] = 'col-' . $i.'-md';
        $gridDesktop['col-' . $i . '-lg'] = 'col-' . $i . '-lg';
    }

    $gridMobile['none'] = 'none';
    $gridTablet['none'] = 'none';
    $gridDesktop['none'] = 'none'; 

    $GLOBALS['gridCssSelector'] = [
        'mobile' => $gridMobile,
        'tablet' => $gridTablet,
        'desktop' => $gridDesktop,
    ];

?>