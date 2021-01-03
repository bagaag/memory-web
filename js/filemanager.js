// A multi-file upload form component
const LIST_ID =             'file-manager-list';            // Container for existing files list
const EDIT_TEMPLATE_ID =    'file-manager-edit-template';   // Template for existing file
const UPLOAD_BTN_ID =       'file-manager-upload';          // Upload form button
const ADD_FORM_ID =         'file-manager-add';             // Upload form
const ADD_NAME_ID =         'new-file-name';                // Name input in upload form
const FILE_LINK_ID =        'file-link-#';                  // Link to existing file
const FILE_NAME_ID =        'file-name-#';                  // Name input for existing file
const DELETE_BTN_ID =       'delete-file-#';                // Delete btn for existing file
const EDIT_FILE_DIV =       'file-manager-edit-#'           // Container for existing file
const BOTTOM_DROP_TARGET =  'reorder-item-last'             // Bottom-of-list drop target

export class FileManager {
    
    constructor(existingFiles) {
        this.files = [];
        this.list = document.getElementById(LIST_ID);
        this.last = document.getElementById(BOTTOM_DROP_TARGET);
        this.editTemplate = document.getElementById(EDIT_TEMPLATE_ID);
        this.editTemplate.style.display = 'none';
        for (let i=0; i<existingFiles.length; i++) {
            this.addFile(existingFiles[i]);
        }
        let uploadBtn = document.getElementById(UPLOAD_BTN_ID);
        uploadBtn.addEventListener('click', () => {
            this.uploadFile();
        });
        // requires reorder.js - calls this function after reorder events
        callAfterReorder = this.updateIndex;
    }

    // adds an existing file to the list
    // fileObj should look like {index: 0, name: 'Name', slug:  extension: 'txt', url: '/path/file.jpg' }
    addFile(fileObj) {
        // add to list of files in memory
        this.files.push(fileObj);
        let fileNo = this.files.length - 1;
        // use template to add to DOM
        let html = this.editTemplate.innerHTML;
        html = html.replaceAll('-#', '-' + String(fileNo));
        this.last.insertAdjacentHTML('beforebegin', html);
        // set link and name
        let link = document.getElementById(FILE_LINK_ID.replaceAll('#', String(fileNo)));
        link.setAttribute('href', fileObj.url);
        link.setAttribute('target', '_blank');
        link.innerText = fileObj.slug + '.' + fileObj.extension;
        let name = document.getElementById(FILE_NAME_ID.replaceAll('#', String(fileNo)));
        name.setAttribute('value', fileObj.name);
        // delete button
        let delBtn = document.getElementById(DELETE_BTN_ID.replaceAll('#', String(fileNo)));
        delBtn.addEventListener('click', () => {
            this.deleteFile(fileNo);
        });
        // add reorder events
        let reorder = document.getElementById(EDIT_FILE_DIV.replaceAll('#', String(fileNo)));
        addDnDHandlers(reorder); // lives in reorder.js
    }

    // removes a file from the list
    deleteFile(fileNo) {
        let el = document.getElementById(EDIT_FILE_DIV.replaceAll('#', String(fileNo)));
        delete this.files[fileNo];
        el.remove();
    }
    
    // event handler for the Upload button click
    uploadFile() {
        let nameField = document.getElementById(ADD_NAME_ID);
        // server-side call will need to return a json object like this:
        let fileObj = {link: '#newfile', name: nameField.value, slug: 'slug', extension: 'png' };
        this.addFile(fileObj);
        let form = document.getElementById(ADD_FORM_ID);
        form.reset();
    }

    // updates hidden file-index fields to match DOM order - called after reorder events
    updateIndex() {
        let ixs = document.getElementsByClassName('file-index');
        for (let i=0; i<ixs.length; i++) {
            let ix = ixs[i];
            if (ix.id != 'file-index-#') {
                ix.setAttribute('value', i);
            }
        }
    }
}
