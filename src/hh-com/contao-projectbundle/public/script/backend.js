/**
 * Grid Selector
 */
function initGridSelector() {
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
            string = string + " " + fields[i].selector.options[fields[i].selector.selectedIndex].value;
        }

        cssField.value = string.trim();
    }

    function onLoadCte(fields) {
        
        // iterate over fields
        let cssClasses = cssField.value.split(" ");
        for (let a = 0; a < fields.length; a++) {

            let selectId = fields[a].id;
            let selectElement = fields[a].selector;

            for (let i = 0; i < selectElement.options.length; i++) {
                if (selectElement.options[i].value == cssClasses[a]) {
                    selectElement.options[i].selected = true;
                    console.log(selectId);
                    //document.querySelector('#select_'+selectId+'_chzn a span').innerHTML = selectElement.options[i].text;
                    //document.querySelector('#select_'+selectId+' a span').innerHTML = "dfdfdf";
                }
            }
        }

        return;

    }

    /**
     * Content - Element List View - Grid Layout
     */
    const elements = document.querySelectorAll('.begridhelper:not(.content-element-group .begridhelper)');
    
    if (elements.length > 0) {

        let conainer = document.querySelector('.tl_listing_container');
        conainer.classList.add('contentList');

        let ulConainer = document.querySelector('.tl_listing_container > ul');
        ulConainer.classList.add('row');

        elements.forEach( el => {
            let col = el.getAttribute('data-gridstyle');

            if (col) {
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

    const elementsInGroup = document.querySelectorAll('.content-element-group .begridhelper');

    if (elementsInGroup.length > 0) {

        let conainer = document.querySelector('.content-element-group');
        conainer.classList.add('contentList');

        let ulConainer = document.querySelector('.content-element-group > div');
        ulConainer.classList.add('row');

        elementsInGroup.forEach( el => {
            let col = el.getAttribute('data-gridstyle');

            if (col) {
                console.log( el.previousElementSibling );
                el.previousElementSibling.className += col.trim();
            }

            let linebreak = el.getAttribute('data-linebreak');
            if (linebreak == 'true') {
                const breaker = document.createElement("div");
                breaker.classList.add('col-12');
                breaker.classList.add('linebreak');                
                el.closest('div').before(breaker);
            }
        
        });
    }
}

console.log(typeof Turbo);
// Check if Turbo.js is available
if (typeof Turbo !== 'undefined') {
    document.addEventListener("turbo:load", function(event) {
        initGridSelector();
    });
} else {
    document.addEventListener("DOMContentLoaded", function(event) {
        initGridSelector();
    });
}