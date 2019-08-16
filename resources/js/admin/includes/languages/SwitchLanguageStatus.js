import {getCsrf} from "../adminTables";

function switchLanguageStatus(id){
    let status = $('#'+id+'-status-text');

    let token = getCsrf();

    $.post(`/${ADMIN_PREFIX}/languages/` + id + '/switch-status', { _token: token }).done(function (data) {
        $(status).text(data.status);
    })
        .fail(function(jqXHR, textStatus, errorThrown){
            getErrorDiv(errorThrown, jqXHR.status)
        });
}

export {switchLanguageStatus}
