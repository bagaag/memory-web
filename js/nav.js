export class DropdownMenus {
    constructor() {
        /* Drop down menus must be formed as follows:
           <div class="nav-main">
             <div class="nav-submenu">
               <div class="nav-trigger"><a href="#">Dropdown Trigger</div>
                 <div class="nav-drop">
                   <div class="nav-item"><a href="URL">Menu Item</a></div>
                 </div>
               </div>
             </div>
           </div>
        */
        this.dropdown = undefined;
        window.onclick = (ev) => {
            let trigger;
            if (ev.target.matches('.nav-trigger')) {
                trigger = ev.target;
            } else if (ev.target.parentElement && ev.target.parentElement.matches('.nav-trigger')) {
                trigger = ev.target.parentElement;
            } else if (ev.target.parentElement.parentElement && ev.target.parentElement.parentElement.matches('.nav-trigger')) {
                trigger = ev.target.parentElement.parentElement;
            } else if (typeof this.dropdown != 'undefined') {
                this.dropdown.style.display = 'none';
                this.dropdown = undefined;
                return;
            }
            if (typeof trigger == 'undefined') return;
            let subMenu = trigger.parentElement;
            let drop = subMenu.getElementsByClassName('nav-drop')[0];
            if (drop.style.display == 'block') {
                drop.style.display = 'none';
            } else {
                // right-align menu if class nav-drop-right is present
                if (drop.matches('.nav-drop-right')) {
                    let triggerRect = trigger.getBoundingClientRect();
                    drop.style.right = (window.innerWidth - triggerRect.right) + 'px';
                }
                drop.style.display = 'block';
                this.dropdown = drop;
            }
        };
    }
}