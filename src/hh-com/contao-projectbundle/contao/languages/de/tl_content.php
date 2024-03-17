<?php


$GLOBALS['TL_LANG']['tl_content']['grid_legend'] = "Grid Layout";
$GLOBALS['TL_LANG']['tl_form_field']['grid_legend'] = "Grid Layout";
$GLOBALS['TL_LANG']['tl_content']['offset_legend'] = "Offset - Abstände Links und Rechts";
$GLOBALS['TL_LANG']['tl_content']['grid_information'] = "Wählen Sie hier die Spaltenbreite für die verschiedenen Bildschirmgrößen aus. Der Wert wird in das Feld Grid Auswahl eingetragen. Schalten Sie dieses Feld auch für Redakteure frei!";
$GLOBALS['TL_LANG']['tl_content']['offset_left_information'] = "Wählen Sie hier den Abstand links für die verschiedenen Bildschirmgrößen aus.";
$GLOBALS['TL_LANG']['tl_content']['offset_right_information'] = "Wählen Sie hier den Abstand rechts für die verschiedenen Bildschirmgrößen aus.";

 
$GLOBALS['TL_LANG']['add_grid'] = ["Grid aktivieren", "Fügt diesem Element ein Grid-Container hinzu."];
$GLOBALS['TL_LANG']['grid_css'] = ["Grid Auswahl", "Auswahl des Grid Selectors wird automatisch übernommen. Nicht alle Werte werden im Frontend angezeigt."];
$GLOBALS['TL_LANG']['grid_content_align'] = ["Ausrichtung des Inhalts", "Dieses Option kann nicht auf alle Element angewendet werden."];
$GLOBALS['TL_LANG']['grid_element_align'] = ["Elemente ausrichten", "Ausrichtung der Elemente innerhalb des Wrappers. Alternativ können Sie auch Offset verwenden."];
$GLOBALS['TL_LANG']['grid_marginless'] = ["Außenabstand deaktivieren", "Deaktivieren sie alle Außenabstand."];
$GLOBALS['TL_LANG']['grid_paddingless'] = ["Innenabstand deaktivieren", "Deaktivieren sie alle Innenabstand."];
$GLOBALS['TL_LANG']['grid_backgroundcolor'] = ["Hintergrundfarbe", "Wählen Sie hier die Hintergrundfarbe für das Element aus."];


$GLOBALS['TL_LANG']['grid_element_align_option'] = [
    'left' => 'Links',
    'center' => 'Zentrieren',
    'right' => 'Rechts',
];
$GLOBALS['TL_LANG']['grid_fullwidth'] = ["100% Bildschirmbreite", "Dieses Element auf 100% des Bildschirms strecken. Achtung: Das Element sollte dabei 12/12 von der Breite des Bildschirms einnehmen."];
$GLOBALS['TL_LANG']['grid_fullwidth_reference'] = [
    'fullwidthpadding' => 'Inhalt 100% - mit Seitenabstand',
    'fullwidth' => 'Inhalt 100% - ohne Seitenabstand',
    'fullwidthbg' => 'Hintergrundfarbe 100% - Inhalt im Container',
];

$GLOBALS['TL_LANG']['grid_bottomspace'] = ["Abstand unter dem Element", "Wählen Sie hier den Abstand unter dem Element aus."];
$GLOBALS['TL_LANG']['grid_bottomspace_reference'] = [
    'bottomspaceMin' => 'Minimiert',
    'bottomspace0' => 'Kein Abstand',
    'bottomspace1-5x' => '1.5 facher Abstand',
    'bottomspace2x' => '2 facher Abstand',
];

$GLOBALS['TL_LANG']['grid_backgroundcolor_reference'] = [
    'bgcolor1' => 'Grau',
    'bgcolor2' => 'Grün',
    'bgcolor3' => 'Blau',
];
$GLOBALS['TL_LANG']['grid'] = [
    'mobile' => [
        'col' => 'Automatisch',
        'col-1' => '1/12',
        'col-2' => '2/12',
        'col-3' => '3/12',
        'col-4' => '4/12',
        'col-5' => '5/12',
        'col-6' => '6/12 Halbe Breite',
        'col-7' => '7/12',
        'col-8' => '8/12',
        'col-9' => '9/12',
        'col-10' => '10/12',
        'col-11' => '11/12',
        'col-12' => '12/12 Volle Breite',
        'none' => 'Keine Wert'
    ],
    'tablet' => [
        'col' => 'Automatisch',
        'col-1-md' => '1/12',
        'col-2-md' => '2/12',
        'col-3-md' => '3/12',
        'col-4-md' => '4/12',
        'col-5-md' => '5/12',
        'col-6-md' => '6/12 Halbe Breite',
        'col-7-md' => '7/12',
        'col-8-md' => '8/12',
        'col-9-md' => '9/12',
        'col-10-md' => '10/12',
        'col-11-md' => '11/12',
        'col-12-md' => '12/12 Volle Breite',
        'none' => 'Keine Wert'
    ], 
    'desktop' => [
        'col' => 'Automatisch',
        'col-1-lg' => '1/12',
        'col-2-lg' => '2/12',
        'col-3-lg' => '3/12',
        'col-4-lg' => '4/12',
        'col-5-lg' => '5/12',
        'col-6-lg' => '6/12 Halbe Breite',
        'col-7-lg' => '7/12',
        'col-8-lg' => '8/12',
        'col-9-lg' => '9/12',
        'col-10-lg' => '10/12',
        'col-11-lg' => '11/12',
        'col-12-lg' => '12/12 Volle Breite',
        'none' => 'Keine Wert'
    ]
];