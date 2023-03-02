
/**
 * Grid Selector
 */

 document.addEventListener("DOMContentLoaded", function(event) {
 

    /**
     * Grid Selector at each content element
     */
    let cssField = document.getElementById('ctrl_grid_css');
    
    if (cssField) {

        let fields = [
            {'id':'mobile', 'selector':document.getElementById('select_mobile')},
            {'id':'tablet', 'selector':document.getElementById('select_tablet')},
            {'id':'desktop', 'selector':document.getElementById('select_desktop')},

            {'id':'mobile_leftoffset', 'selector':document.getElementById('select_mobile_leftoffset')},
            {'id':'tablet_leftoffset', 'selector':document.getElementById('select_tablet_leftoffset')},
            {'id':'desktop_leftoffset', 'selector':document.getElementById('select_desktop_leftoffset')},

            {'id':'mobile_rightoffset', 'selector':document.getElementById('select_mobile_rightoffset')},
            {'id':'tablet_rightoffset', 'selector':document.getElementById('select_tablet_rightoffset')},
            {'id':'desktop_rightoffset', 'selector':document.getElementById('select_desktop_rightoffset')},
        ];

        onLoadCte(fields);

        for (let i = 0; i < fields.length; i++) {
            fields[i].selector.onchange = function() {
                updateGridCSS(fields)
            };
        }

    }

    // CTE Grid Selector Update chosen values
    function updateGridCSS(fields) {

        let string = "";
        
        for (let i = 0; i < fields.length; i++) {

            //console.log( (fields[i].selector.options[fields[i].selector.selectedIndex].value -1) );
            string = string + " " + fields[i].selector.options[fields[i].selector.selectedIndex].value;
        }
        cssField.value = ( string.trim() );
    }

    function onLoadCte(fields) {
        
        
        // iterate over fields
        let cssClasses = cssField.value.split(" ");
        for (let a = 0; a < fields.length; a++) {

            let selectId = fields[a].id;
            let selectElement = fields[a].selector;

            console.log(cssClasses);
            for (let i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].value == cssClasses[a]) {
                    selectElement.options[i].selected = true;
                    console.log(selectId);
                    document.querySelector('#select_'+selectId+'_chzn a span').innerHTML = selectElement.options[i].text;
                  
                }
            }

        }

        return;

        console.log(fields);
       

        if (cssClasses[0]) {
            for (let i = 0; i < mobile.options.length; i++) {
                if (mobile.options[i].value == cssClasses[0]) {
                    mobile.options[i].selected = true;
                    document.querySelector('#select_mobile_chzn a span').innerHTML = mobile.options[i].text;
                }
            }
        } else {
            mobile.options[1].selected = true;
            document.querySelector('#select_mobile_chzn a span').innerHTML = mobile.options[1].text;
        }

        if (cssClasses[1]) {
            for (let i = 0; i < tablet.options.length; i++) {
                if (tablet.options[i].value == cssClasses[1]) {
                    tablet.options[i].selected = true;
                    document.querySelector('#select_tablet_chzn a span').innerHTML = tablet.options[i].text;
                }
            }
        } else {
            tablet.options[1].selected = true;
            document.querySelector('#select_tablet_chzn a span').innerHTML = tablet.options[1].text;
        }

        if (cssClasses[2]) {
            for (let i = 0; i < desktop.options.length; i++) {
                if (desktop.options[i].value == cssClasses[2]) {
                    desktop.options[i].selected = true;
                    document.querySelector('#select_desktop_chzn a span').innerHTML = desktop.options[i].text;
                }
            }
        } else {
            desktop.options[1].selected = true;
            document.querySelector('#select_desktop_chzn a span').innerHTML  = desktop.options[1].text;
        }

        console.log(cssClasses);

        updateGridCSS(mobile, tablet, desktop, mobile_leftoffset, tablet_leftoffset, desktop_leftoffset, mobile_rightoffset, tablet_rightoffset, desktop_rightoffset)
    }

    function onLoadCtexxx(mobile, tablet, desktop, mobile_leftoffset, tablet_leftoffset, desktop_leftoffset, mobile_rightoffset, tablet_rightoffset, desktop_rightoffset) {
        
        let cssClasses = cssField.value.split(" ");

        if (cssClasses[0]) {
            for (let i = 0; i < mobile.options.length; i++) {
                if (mobile.options[i].value == cssClasses[0]) {
                    mobile.options[i].selected = true;
                    document.querySelector('#select_mobile_chzn a span').innerHTML = mobile.options[i].text;
                }
            }
        } else {
            mobile.options[1].selected = true;
            document.querySelector('#select_mobile_chzn a span').innerHTML = mobile.options[1].text;
        }

        if (cssClasses[1]) {
            for (let i = 0; i < tablet.options.length; i++) {
                if (tablet.options[i].value == cssClasses[1]) {
                    tablet.options[i].selected = true;
                    document.querySelector('#select_tablet_chzn a span').innerHTML = tablet.options[i].text;
                }
            }
        } else {
            tablet.options[1].selected = true;
            document.querySelector('#select_tablet_chzn a span').innerHTML = tablet.options[1].text;
        }

        if (cssClasses[2]) {
            for (let i = 0; i < desktop.options.length; i++) {
                if (desktop.options[i].value == cssClasses[2]) {
                    desktop.options[i].selected = true;
                    document.querySelector('#select_desktop_chzn a span').innerHTML = desktop.options[i].text;
                }
            }
        } else {
            desktop.options[1].selected = true;
            document.querySelector('#select_desktop_chzn a span').innerHTML  = desktop.options[1].text;
        }

        console.log(cssClasses);

        updateGridCSS(mobile, tablet, desktop, mobile_leftoffset, tablet_leftoffset, desktop_leftoffset, mobile_rightoffset, tablet_rightoffset, desktop_rightoffset)
    }

    /**
     * Content - Element List View - Grid Layout
     */
    const elements = document.querySelectorAll('.begridhelper');
    
    if (elements.length > 0) {

        let conainer = document.querySelector('.tl_listing_container');
        conainer.classList.add('contentList');

        let ulConainer = document.querySelector('.tl_listing_container > ul');
        ulConainer.classList.add('row');

        elements.forEach( el => {
            let col = el.getAttribute('data-gridstyle');

            if (col) {
                //el.closest('li').classList.add(col.trim());
                el.closest('li').className += col.trim();
            }

            let linebreak = el.getAttribute('data-linebreak');
            if (linebreak == 'true') {
                const breaker = document.createElement("li");
                breaker.classList.add('col-12');
                breaker.classList.add('linebreak');                
                el.closest('li').before(breaker);
            }
           
        });
    }
});
