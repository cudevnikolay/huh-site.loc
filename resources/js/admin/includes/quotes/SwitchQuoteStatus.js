import {getCsrf} from "../adminTables";

function switchQuoteStatus(id){
    let status = $('#'+id+'-status-text');

    let token = getCsrf();

    $.post(`/${ADMIN_PREFIX}/api/quotes/` + id + '/switch-status', { _token: token }).done(function (data) {
        $(status).text(data.status);
    })
        .fail(function(jqXHR, textStatus, errorThrown){
            getErrorDiv(errorThrown, jqXHR.status)
        });
}

export { switchQuoteStatus };
