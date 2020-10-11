require('./bootstrap');

import Clipboard from "clipboard/dist/clipboard";
import tippy from 'tippy.js';
import 'tippy.js/dist/tippy.css'; // optional for styling

document.querySelectorAll('.copy-venue-url').forEach((el) => {

    let clipboard = new Clipboard(el);
    clipboard.on('success', function(e) {
        tippy(el, {
            placement: 'bottom',
            content: 'Copied!',
        }).show();
    });

    clipboard.on('error', function(e) {
        tippy(el, {
            placement: 'bottom',
            content: 'Failed to copy!',
        }).show();
    });
});
document.querySelectorAll('.close-button').forEach(el => {
    el.addEventListener('click', (event) => {
        event.stopPropagation();
        console.log(event)
    })
});
