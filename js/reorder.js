/* Source: https://codepen.io/retrofuturistic/pen/tlbHE */

var dragSrcEl = null;
var callAfterReorder = false; // set to function if needed

function handleDragStart(e) {
    //console.log('handleDragStart',e, this)
    // Target (this) element is the source node.
    dragSrcEl = this;

    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.outerHTML);

    this.classList.add('dragElem');
}
function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault(); // Necessary. Allows us to drop.
    }
    this.classList.add('over');

    e.dataTransfer.dropEffect = 'move';  // See the section on the DataTransfer object.

    return false;
}

function handleDragEnter(e) {
    // this / e.target is the current hover target.
}

function handleDragLeave(e) {
    this.classList.remove('over');  // this / e.target is previous target element.
}

function handleDrop(e) {
    // this/e.target is current target element.

    if (e.stopPropagation) {
        e.stopPropagation(); // Stops some browsers from redirecting.
    }

    // Don't do anything if dropping the same column we're dragging.
    if (dragSrcEl != this) {
        // Set the source column's HTML to the HTML of the column we dropped on.
        this.parentNode.removeChild(dragSrcEl);
        var dropHTML = e.dataTransfer.getData('text/html');
        this.insertAdjacentHTML('beforebegin', dropHTML);
        var dropElem = this.previousSibling;
        addDnDHandlers(dropElem);
        if (typeof callAfterReorder == 'function') {
            callAfterReorder();
        }
    } else {
    }
    this.classList.remove('over');
    return false;
}

function handleDragEnd(e) {
    // this/e.target is the source node.
    this.classList.remove('over');
    this.classList.remove('dragElem');
}

function addDnDHandlers(elem) {
    //console.log('addDnDHandlers', elem);
    elem.addEventListener('dragstart', handleDragStart, false);
    elem.addEventListener('dragenter', handleDragEnter, false)
    elem.addEventListener('dragover', handleDragOver, false);
    elem.addEventListener('dragleave', handleDragLeave, false);
    elem.addEventListener('drop', handleDrop, false);
    elem.addEventListener('dragend', handleDragEnd, false);
}

// place an invisible div w/ height of 10px at the bottom of the list
// to act as a drop target. without this, items can't be moved to the
// bottom of the list
// e.g. <div id="reorder-item-last" class="reorder-item" style="height:10px"></div>
addDnDHandlers(document.getElementById('reorder-item-last'));

// to use, call addDnDHandlers for each draggable item:
//var reorders = document.getElementsByClassName('reorder-item');
//for (let i=0; i<reorders.length; i++) {
//    addDnDHandlers(reorders[i]);    
//}
