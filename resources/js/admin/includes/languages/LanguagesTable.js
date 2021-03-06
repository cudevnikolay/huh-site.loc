import {
    processing_img,
    getCsrf,
    getPageLength,
    getErrorDiv,
    saveTableSizeToCookies,
    blurTableWhenLoad,
} from "../adminTables";
import {switchLanguageStatus} from "./SwitchLanguageStatus";

let languagesLengthCookieName = 'languages_length';
let languagesDefaultLength = 10;
const table = $('#languages');

const languagesTable = table.DataTable({
    "order": [[0, 'asc']],
    autoWidth: false,
    "oLanguage": {
        "sProcessing": processing_img
    },
    "processing": true,
    "serverSide": true,
    "ajax": {
        "url": `/${ADMIN_PREFIX}/api/translations/`,
        "dataType": "json",
        "type": "POST",
        "data": {_token: getCsrf()},
        'error': function (jqXHR, textStatus, errorThrown) {
            let errorDiv = getErrorDiv(errorThrown, jqXHR.status);
            $('section.content-header').after(errorDiv);
        }
    },
    "drawCallback": function (settings) {
        $('.language-status').on('click', function () {
            switchLanguageStatus($(this).data('id'));
        });
        $('.delete-language-button').on('click', function () {
            let url = $(this).prop('href');
            $('#modal').modal('show');
            $('#modal-delete').on('click', function () {
                if (url) {
                    $.ajax({
                        type: 'delete',
                        url: url,
                        data: {_token: getCsrf()},
                        success: function (data) {
                            $('#modal').modal('hide');
                            languagesTable.draw();
                            url = null;
                        },
                        'error': function (jqXHR, textStatus, errorThrown) {
                            let errorDiv = getErrorDiv(errorThrown, jqXHR.status);
                            $('section.content-header').after(errorDiv);

                        }
                    });
                }
            });

            $('#modal-close').on('click', function () {
                $('#modal').modal('hide');
            });
            return false;
        });
    },
    "dom": "<'row'<'col-sm-6'f><'col-sm-6'l>>" +
    "<'row'<'col-sm-12 table-responsive'tr>>" +
    "<'row'<'col-sm-5'i><'col-sm-7'p>>",

    "columns": [
        {
            "data": "id",
            render: function (data, type, row) {
                return `${data}`;
            },
        },
        {
            "data": null,
            render: function (data, type, row) {
                if (data.enabled === 'default') {
                    return `<i class="fa fa-lock"></i> Default`;
                } else {
                    let checked = data.enabled === 1 ? 'checked' : '';
                    return `<label class="switch">
  <input class="language-status" data-id="${data.id}" type="checkbox" ${checked}>
  <span class="slider round"></span>
</label>`;
                }

            },
        },
        {
            "data": null,
            render: function (data, type, row) {
                return `<a href="${data.edit}">${data.name}</a>`;
            },
        },
        {
            "data": "locale",
            render: function (data, type, row) {
                return `${data}`;
            },
        },
        {
            "data": null,
            render: function (data, type, row) {
                let deleteButton = '';
                if (data.delete) {
                    deleteButton = `<div>
                            <a href="${data.delete}" class="btn-sm btn-danger delete-language-button " data-toggle="modal" 
        data-target="#myModal">
                                <i class="glyphicon glyphicon-trash"></i>
                                <span>Delete</span>
                            </a>
                        </div>`
                }
                return `<div class="actions" style="width: 150px;margin: 0 auto">
                                <div class="pull-left">
                                    <a href="${data.edit}" class="btn-primary btn-sm">
                                        <i class="glyphicon glyphicon-pencil"></i>
                                        <span>Edit</span>
                                    </a>
                                </div>
                                ${deleteButton}

                            </div>
                            
                    </div>`;
            },
            'orderable': false
        },
    ],
    "pageLength": getPageLength(languagesLengthCookieName, languagesDefaultLength),
    lengthMenu: [[10, 20, 50, 100, 500], [10, 20, 50, 100, 500]]
});

saveTableSizeToCookies(table, languagesLengthCookieName);
blurTableWhenLoad(table);