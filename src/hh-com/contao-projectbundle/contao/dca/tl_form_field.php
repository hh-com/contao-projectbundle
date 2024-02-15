<?php

Contao\Files::getInstance()->rrdir('var/cache/dev/contao', true);
Contao\Files::getInstance()->rrdir('var/cache/prod/contao', true);


if (Contao\Input::get('do') == 'form') {
    $dontShowGridSelectorIn = ['__selector__','unfiltered_html'];

    foreach ($GLOBALS['TL_DCA']['tl_form_field']['palettes'] as $key => $value)
    {
        if (in_array($key, $dontShowGridSelectorIn, true))
            continue;

        $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$key] = str_replace(
            '{expert_legend:hide}',
            '{grid_legend},grid_css_selector,grid_css;{expert_legend:hide}',
            $GLOBALS['TL_DCA']['tl_form_field']['palettes'][$key]
        );
    }
}

$GLOBALS['TL_DCA']['tl_form_field']['fields']['grid_css_selector'] = [
    'input_field_callback'    => array('tl_form_field_extnd', 'gridCssSelector'),
]; 
$GLOBALS['TL_DCA']['tl_form_field']['fields']['grid_css'] = [
    'label'                   => &$GLOBALS['TL_LANG']['grid_css'],          
    'exclude'                 => true,
    'inputType'               => 'text',
    'eval'                    => ['tl_class'=>'w50 readonly-writable', 'disabled' => false],
    'sql'                     => "varchar(32) NOT NULL default 'col-12'"
];

class tl_form_field_extnd extends Contao\Backend
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
                Wählen Sie hier die Breiten für die jeweiligen Geräte aus. Der Wert wird in das Fels Experteneinstellungen -> Klasse eingetragen.
                Schalten Sie dieses Feld auch für Redakteure frei!
            </div>
        </div>
        ';
    }

}