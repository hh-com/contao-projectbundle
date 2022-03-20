## Boilerplate for Contao Bundle

## Install

Copy to:  
root  
\- src  
\- - hh-com  
\- - - contao-projectbundle  

Update your contao installation composer.json
``` code
"repositories": [
    {
        "type": "path",
        "url": "src/hh-com/contao-projectbundle",
        "options": {
                "symlink": true
        }
    }
],
"require": {
    ...
    "hh-com/contao-projectbundle": "@dev",
    ... 
}
```