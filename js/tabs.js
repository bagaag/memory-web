export function tabClick (evt) {
    let tabId = evt.currentTarget.dataset.tab;
    openType(tabId);
}

export function openType (tabId) {
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

// set the click event for .tablinks
let links = document.getElementsByClassName('tablinks');
for (let i=0; i<links.length; i++) {
    links[i].addEventListener("click", tabClick)
}
