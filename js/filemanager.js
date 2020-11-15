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

export class FileManager {
    
    constructor(existingFiles) {
        this.files = [];
        this.list = document.getElementById(LIST_ID);
        this.editTemplate = document.getElementById(EDIT_TEMPLATE_ID);
        this.editTemplate.style.display = 'none';
        for (let i=0; i<existingFiles.length; i++) {
            this.addFile(existingFiles[i]);
        }
        let uploadBtn = document.getElementById(UPLOAD_BTN_ID);
        uploadBtn.addEventListener('click', () => {
            this.uploadFile();
        });
    }

    // adds an existing file to the list
    // fileObj should look like {link: 'url', name: 'Name', slug: 'name', extension: 'txt' }
    addFile(fileObj) {
        // add to list of files in memory
        this.files.push(fileObj);
        let fileNo = this.files.length - 1;
        // use template to add to DOM
        let html = this.editTemplate.innerHTML;
        html = html.replaceAll('-#', '-' + String(fileNo));
        console.log(html);
        this.list.insertAdjacentHTML('beforeend', html);
        // set link and name
        let link = document.getElementById(FILE_LINK_ID.replaceAll('#', String(fileNo)));
        link.setAttribute('href', fileObj.link);
        link.innerText = fileObj.slug + '.' + fileObj.extension;
        let name = document.getElementById(FILE_NAME_ID.replaceAll('#', String(fileNo)));
        name.value = fileObj.name;
        // delete button
        let delBtn = document.getElementById(DELETE_BTN_ID.replaceAll('#', String(fileNo)));
        delBtn.addEventListener('click', () => {
            this.deleteFile(fileNo);
        });
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
        let fileObj = {link: '#newfile', name: nameField.value, ext: 'png' };
        this.addFile(fileObj);
        let form = document.getElementById(ADD_FORM_ID);
        form.reset();
    }
} 