var _files = {
    index: null,
    tags: {
        form: '.file-form',
        files: '.files-list',
        newFile: '.files-list-new-file',
        filesListForm: '.files-list-form',
        uplProgress: '.files-list-new-file p',
    },
    fields: {
        filesListFile: '.files-list-file',
        uploadedFiles: '.files-list-uploaded-files',
    },
    selectFiles: function(obj) {
        $(_files.tags.filesListForm + _files.getDataIndex($(obj).parents(_files.tags.files).data('index'))).find(_files.fields.filesListFile).click();
    },
    getDataIndex: function(index) {
        return '[data-index="' + index + '"]';
    },
    uploadFiles: function(obj) {
        var form = $(obj).parents('form');
        var list = $(_files.tags.files + _files.getDataIndex(form.data('index'))); //form ul
        var files = $(obj)[0].files;
        var name = files[0].name;
        var type = name.split('.'); //failis saxelis dakofa
        type = type[type.length - 1].toLowerCase(); //failis tipis dadgena
        if (list.data('types').indexOf(type) == -1) {
            jAlert('ატვირთეთ ' + list.data('types') + ' ტიპის ფაილ(ებ)ი', 'Warning');
            form[0].reset();
            return false;
        }
        list.find(_files.tags.newFile).addClass('files-list-uploading'); // add uploading progress
        form.ajaxForm({
            beforeSend: function(xhr) {
                //pr.form.find(pr.tags.uplCancel).click(xhr.abort);
            },
            uploadProgress: function(event, position, total, percentComplete) { //on progress
                list.find(_files.tags.uplProgress).text('Uploading ' + percentComplete + '%'); //update progressbar percent complete
            },
            complete: function(response) {
                data = $.parseJSON(response.responseText);
                if (data.StatusCode == 1) {
                    var files = [];
                    var type = list.data('type');
                    for (i = 0; i < data.Data.FilesList.length; i++) {
                        if (type == 'doc') {
                            files[files.length] =
                                '<li data-file="' + data.Data.FilesList[i] + '">' +
                                '<p>' + data.Data.FilesList[i] + '</p>' +
                                '<i onClick="_files.mainFile(this);" class="home" title="მთავარ ფაილად დაყენება"></i>' +
                                '<i onClick="_files.removeFile(this);" title="Delete"></i>' +
                                '</li>';
                        } else if (type == 'video') {
                            files[files.length] =
                                '<li data-file="' + data.Data.FilesList[i] + '">' +
                                '<video controls>' +
                                '<source src="' + data.Data.FilesList[i] + '" type="video/mp4">' +
                                'Your browser does not support the video tag.' +
                                '</video>' +
                                '<i onClick="_files.mainFile(this);" class="home" title="მთავარ ფაილად დაყენება"></i>' +
                                '<i onClick="_files.removeFile(this);" title="Delete"></i>' +
                                '</li>';
                        } else {
                            files[files.length] =
                                '<li class="file-list-item" data-file="' + data.Data.FilesList[i] + '">' +
                                '<img src="' + data.Data.FilesList[i] + '"/>' +
                                '<i onClick="_files.mainFile(this);" class="home" title="მთავარ სურათად დაყენება"></i>' +
                                '<i class="fa fa-times" aria-hidden="true" onclick="_files.removeFile(this);" title="Delete"></i>' +
                                '</li>';
                        }
                    }
                    list.find(_files.tags.newFile).before(files.join(''));
                    _files.appendFilesForm($(obj).parents('form').data('index'), $(obj).parents('form').data('name'));
                    _files.updateFilesCnt(list, form);
                } else {
                    console.log(data.StatusMessage);
                }
                list.find(_files.tags.newFile).removeClass('files-list-uploading');
                list.find(_files.tags.uplProgress).text('Upload File');
                form[0].reset();
                //} else {
                //jAlert(pr.upload.data.uplErrorMessage);
                //}
                //pr.upload.removeLoader();
            }
        }).submit();
    },
    appendFilesForm: function(index, name) {
        $('.file-names' + _files.getDataIndex(index)).remove();
        fileNames = [];
        $(_files.tags.files + _files.getDataIndex(index) +' .file-list-item').each(function(i, v){
            let file = $(v).data('file').split('/');
            fileNames.push(file[file.length - 1]);
        });
        $(_files.tags.form).append('<input type="hidden" class="file-names" data-index="'+ index +'" name="'+ name +'" value="' + fileNames.join(',') + '">');
    },
    updateFilesCnt: function(list, form) {
        var cnt = list.find('li').length - 1;
        form.find(_files.fields.uploadedFiles).val(list.find('li').length - 1);
        if (cnt >= list.data('max-files')) {
            list.find(_files.tags.newFile).hide();
        } else {
            list.find(_files.tags.newFile).show();
        }
    },
    removeFile: function(obj) {
        jConfirm('გსურთ წაშლა?', null, function(e) {
            if (e) {
                var list = $(obj).parents(_files.tags.files);
                $(obj).parent().remove();
                _files.appendFilesForm($(list).data('index'), $(list).data('name'));
                _files.updateFilesCnt(list, $(_files.tags.filesListForm + _files.getDataIndex(list.data('index'))));
            }
        });
    },
    mainFile: function(obj) {
        var obj = $(obj).parent();
        obj.parents(_files.tags.files).prepend(obj.clone());
        obj.remove();
    },
}