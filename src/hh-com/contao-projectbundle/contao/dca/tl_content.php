<?php

Contao\Files::getInstance()->rrdir('var/cache/dev/contao', true);
Contao\Files::getInstance()->rrdir('var/cache/prod/contao', true);

#$GLOBALS['TL_DCA']['tl_content']['config']['onload_callback'][] = array('tl_content_extnd', 'addRemoveGridCallback');
$GLOBALS['TL_DCA']['tl_content']['config']['onsubmit_callback'][] = array('tl_content_extnd', 'addRemoveGridCallback');



    // Wrapper
    $GLOBALS['TL_DCA']['tl_content']['palettes']['grid_row_start'] = '
        type;
        {grid_legend},grid_css_selector,grid_css;
        {offset_legend},gridOffsetLeft,gridOffsetRight;
        grid_element_align,grid_fullwidth,grid_backgroundcolor;
        grid_paddingless,grid_marginless,grid_bottomspace;
        {template_legend:hide},customTpl;{protected_legend:hide},protected;{invisible_legend:hide},invisible,start,stop
    ';
    $GLOBALS['TL_DCA']['tl_content']['palettes']['grid_row_end'] = 'type;{invisible_legend:hide},invisible';

    $GLOBALS['TL_DCA']['tl_content']['palettes']['__selector__'][] = 'add_grid';


    $GLOBALS['TL_DCA']['tl_content']['subpalettes']['add_grid'] = '
        {grid_legend},grid_css_selector,grid_css,
        {offset_legend},gridOffsetLeft,gridOffsetRight,
        grid_fullwidth,grid_backgroundcolor,grid_bottomspace,
        grid_paddingless,grid_marginless
    ';

if (Contao\Input::get('do') == 'article' || Contao\Input::get('do') == 'news') {
    
    $dontShowGridSelectorIn = $GLOBALS['dontCreateGrid'];
    array_push($dontShowGridSelectorIn, '__selector__');

    foreach ($GLOBALS['TL_DCA']['tl_content']['palettes'] as $key => $value)
    {
        if (in_array($key, $dontShowGridSelectorIn, true))
            continue;

        $GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = str_replace(
            'type,',
            'type,grid_content_align;',
            $GLOBALS['TL_DCA']['tl_content']['palettes'][$key]
        );

        $GLOBALS['TL_DCA']['tl_content']['palettes'][$key] = str_replace(
            '{protected_legend:hide}',
            'add_grid;
            {protected_legend:hide}',
            $GLOBALS['TL_DCA']['tl_content']['palettes'][$key]
        );
    }
}




$GLOBALS['TL_DCA']['tl_content']['fields']['grid_css_selector'] = [
    'input_field_callback'    => array('tl_content_extnd', 'gridCssSelector'),
];
$GLOBALS['TL_DCA']['tl_content']['fields']['gridOffsetLeft'] = [
    'input_field_callback'    => array('tl_content_extnd', 'gridOffsetLeft'),
];
$GLOBALS['TL_DCA']['tl_content']['fields']['gridOffsetRight'] = [
    'input_field_callback'    => array('tl_content_extnd', 'gridOffsetRight'),
];

// Only readable textfield für chosen grid css class
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_css'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_css'],       
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => ['tl_class'=>'w50 readonly-writable', 'disabled' => false],
    'sql'                     => "varchar(128) NOT NULL default 'col-12'"
]; 

// Disable grid container
$GLOBALS['TL_DCA']['tl_content']['fields']['add_grid'] = [
    'label'                   => &$GLOBALS['TL_LANG']['add_grid'],       
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => ['tl_class'=>'clr w20','submitOnChange'=>true],
    'sql'                     => array('type' => 'boolean', 'default' => true)
];

// Allign content in grid element
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_element_align'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_element_align'],       
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => ['left', 'center' ,'right'],
    'reference'              => &$GLOBALS['TL_LANG']['grid_element_align_option'],
    'eval'                    => ['tl_class'=>'w25','includeBlankOption'=>true],
    'sql'                     => "varchar(16) NOT NULL default 'left'"
]; 

$GLOBALS['TL_DCA']['tl_content']['fields']['grid_fullwidth'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_fullwidth'],       
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => ['fullwidth', 'fullwidthpadding' ,'fullwidthbg'],
    'reference'               => &$GLOBALS['TL_LANG']['grid_fullwidth_reference'],
    'eval'                    => ['tl_class'=>'w25','includeBlankOption'=>true],
    'sql'                     => "varchar(32) NOT NULL default ''"
]; 
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_backgroundcolor'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_backgroundcolor'],       
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => ['bgcolor1', 'bgcolor2' ,'bgcolor3'],
    'reference'               => &$GLOBALS['TL_LANG']['grid_backgroundcolor_reference'],
    'eval'                    => ['tl_class'=>'w25','includeBlankOption'=>true],
    'sql'                     => "varchar(32) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_bottomspace'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_bottomspace'],       
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => ['bottomspaceMin' ,'bottomspace0'],
    'reference'               => &$GLOBALS['TL_LANG']['grid_bottomspace_reference'],
    'eval'                    => ['tl_class'=>'w50','includeBlankOption'=>true],
    'sql'                     => "varchar(32) NOT NULL default ''"
];
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_paddingless'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_paddingless'],       
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => ['tl_class'=>'w25','submitOnChange'=>false],
    'sql'                     => array('type' => 'boolean', 'default' => false)
];
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_marginless'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_marginless'],       
    'exclude'                 => true,
    'inputType'               => 'checkbox',
    'eval'                    => ['tl_class'=>'w25','submitOnChange'=>false],
    'sql'                     => array('type' => 'boolean', 'default' => false)
];
$GLOBALS['TL_DCA']['tl_content']['fields']['grid_content_align'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_content_align'],       
    'exclude'                 => true,
    'inputType'               => 'select',
    'options'                 => ['left', 'center' ,'right'],
    'reference'              => &$GLOBALS['TL_LANG']['grid_content_align'],
    'eval'                    => ['tl_class'=>'w30','includeBlankOption'=>false],
    'sql'                     => "varchar(32) NOT NULL default 'left'"
]; 





class tl_content_extnd extends Contao\Backend
{

    public function gridCssSelector($dc, $label)
    {
        $dropdown = [];

        foreach ($GLOBALS['gridCssSelector'] as $typeKey => $types) {
            $dropdown[$typeKey] = [];
            foreach ($types as $col => $val) {
                $dropdown[$typeKey][] = '<option value="' . $col . '">' .$GLOBALS['TL_LANG']['grid'][$typeKey][$col ] . '</option>';
            }
        }
        
        return '
        <div class="customcontainer w50">
            <div class="gridselector">
                <label class="w33"> Mobile 
                    <select id="select_mobile" class="tl_select tl_chosen ">'.implode($dropdown['mobile']).'</select>
                </label>
                <label class="w33"> Tablets
                    <select id="select_tablet" class="tl_select tl_chosen">'.implode($dropdown['tablet']).'</select>
                </label>
                <label class="w33"> Desktop
                    <select id="select_desktop" class="tl_select tl_chosen">'.implode($dropdown['desktop']).'</select>
                </label>
            </div>
            <div class="beinformation">
                '. $GLOBALS['TL_LANG']['tl_content']['grid_information'] .'
            </div>
        </div>
        ';
    }

    public function gridOffsetLeft($dc, $label)
    {
        $dropdown = [];

        foreach ($GLOBALS['gridCssSelector'] as $typeKey => $types) {
            $tmp = "";
            $dropdown[$typeKey] = [];
            if ($typeKey == "desktop") {
                $tmp = "-lg";
            }
            if ($typeKey == "tablet") {
                $tmp = "-md";
            }
           
            for ($i = 0; $i <= $GLOBALS['gridColumnsCount'] ; $i++) {
                $dropdown[$typeKey][] = '<option value="offset-left-' . $i .$tmp.'">' . $i .'/12</option>';
            }
        }

        return '
        <div class="customcontainer widget clr w50">
            <div class="offset-left-selector gridselector">
                <label class="w33"> Offset left - Mobile 
                    <select id="select_mobile_leftoffset" class="tl_select tl_chosen ">'.implode($dropdown['mobile']).'</select>
                </label>
                <label class="w33"> Offset left - Tablets
                    <select id="select_tablet_leftoffset" class="tl_select tl_chosen">'.implode($dropdown['tablet']).'</select>
                </label>
                <label class="w33"> Offset left - Desktop
                    <select id="select_desktop_leftoffset" class="tl_select tl_chosen">'.implode($dropdown['desktop']).'</select>
                </label>
            </div>
            <div class="beinformation">
               '.$GLOBALS['TL_LANG']['tl_content']['offset_left_information'].'
            </div>
        </div>
        ';
    }

    public function gridOffsetRight($dc, $label)
    {
        $dropdown = [];

        foreach ($GLOBALS['gridCssSelector'] as $typeKey => $types) {
            $tmp = "";
            $dropdown[$typeKey] = [];
            if ($typeKey == "desktop") {
                $tmp = "-lg";
            }
            if ($typeKey == "tablet") {
                $tmp = "-md";
            }
            for ($i = 0; $i <= $GLOBALS['gridColumnsCount'] ; $i++) {
                $dropdown[$typeKey][] = '<option value="offset-right-' . $i .$tmp.'">' . $i .'/12</option>';
            }
        }

        return '
        <div class="customcontainer widget w50">
            <div class="offset-right-selector gridselector">
                <label class="w33"> Offset right - Mobile 
                    <select id="select_mobile_rightoffset" class="tl_select tl_chosen ">'.implode($dropdown['mobile']).'</select>
                </label>
                <label class="w33"> Offset right - Tablets
                    <select id="select_tablet_rightoffset" class="tl_select tl_chosen">'.implode($dropdown['tablet']).'</select>
                </label>
                <label class="w33"> Offset right - Desktop
                    <select id="select_desktop_rightoffset" class="tl_select tl_chosen">'.implode($dropdown['desktop']).'</select>
                </label>
            </div>
            <div class="beinformation">
            '.$GLOBALS['TL_LANG']['tl_content']['offset_right_information'].'
            </div>
        </div>
        ';
    }
    
    public function addRemoveGridCallback($dc)
    {
        if ($dc->id) {
            if ($dc->activeRecord->type) {
                if ($dc->activeRecord->type == "grid_row_start") {
                    $objDatabase = Contao\Database::getInstance();
                    $objDatabase->prepare("UPDATE tl_content SET add_grid = ? WHERE id = ?")->execute(1, $dc->id);
                } elseif($dc->activeRecord->type) {
                    if (in_array($dc->activeRecord->type, $GLOBALS['dontCreateGrid'])) {
                        $objDatabase = Contao\Database::getInstance();
                        $objDatabase->prepare("UPDATE tl_content SET add_grid = ? WHERE id = ?")->execute(0, $dc->id);
                    } 
                }
            }
        }
    }
    




}