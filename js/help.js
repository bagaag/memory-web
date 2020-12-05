/*  
This module looks for markup like this:

    <label for="field" title="This is some help text." class="helper">Label Text</label>

And transforms it into this:

    <label for="field" class="help">Label Text <img src="/images/help.png"></label>
    <label for="field" style="display:none" class="helper-text">This is some help text.</label>

With an onclick event to show/hide the help-text label.

Usage:

    <script type="module">
        import { setupHelp } from '/js/help.js';
        setupHelp();
    </script>
*/

export function setupHelp() {
    let labels = document.getElementsByClassName('helper');
    for (let i=0; i<labels.length; i++) {
        let label = labels[i];
        // remove the title attribute
        let helpText = label.title;
        label.removeAttribute('title');
        // add the help icon
        let icon = document.createElement('img');
        icon.setAttribute('src', '/images/help.png');
        icon.setAttribute('style', 'height:18px;width:18px;');
        label.insertAdjacentElement('beforeend', icon);
        // add the help-text label element
        let helpTextLabel = document.createElement('label');
        helpTextLabel.setAttribute('style', 'display:none');
        helpTextLabel.textContent = helpText;
        helpTextLabel.setAttribute('class','helper-text');
        label.insertAdjacentElement('afterend', helpTextLabel);
        // click to show
        label.addEventListener('click', (ev) => {
            let target = ev.target;
            // if the img was clicked, we want the parent label
            if (target.tagName.toLowerCase() === 'img') {
                target = target.parentElement;
            }
            let helpText = target.nextSibling;
            if (helpText.style.display === 'none') {
                helpText.style.display = 'block';
            } else {
                helpText.style.display = 'none';
            }
        });
        // click to hide 
        helpTextLabel.addEventListener('click', (ev) => {
            ev.target.style.display = 'none';
        });
    }
}