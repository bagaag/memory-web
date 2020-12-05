/* 
    Enables tab component as follows:
        <div class="tab">
        <button class="tablinks" data-tab="tab-1">Tab Label</button>
        <button class="tablinks" data-tab="tab-2">Tab Label</button>
    </div>
    <div id="tab-1" class="tabcontent">Tab Content</div>
    <div id="tab-2" class="tabcontent">Tab Content</div>
    
    <script type="module">
    import { openTab } from '/js/tabs.js';
    openTab('tab-1'); // optionally displays the default tab
    </script>
*/

export function tabClick (evt) {
    let tabId = evt.currentTarget.dataset.tab;
    openTab(tabId);
}

export function openTab (tabId) {
    let i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        let tablink = tablinks[i];
        if (tablink.dataset.tab == tabId) {
            tablink.classList.add('active');
        } else {
            tablink.classList.remove('active');
        }
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    let showTab = document.getElementById(tabId);
    if (showTab != null) {
        showTab.style.display = "block";
    } else {
        console.warn('could not find .tabcontent with ID ' + tabId);
    }
}

export function setupTabs() {
    // set the click event for .tablinks
    let links = document.getElementsByClassName('tablinks');
    for (let i=0; i<links.length; i++) {
        links[i].addEventListener("click", tabClick)
    }
}
