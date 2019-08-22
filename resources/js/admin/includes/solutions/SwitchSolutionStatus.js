import {getCsrf} from "../adminTables";

function switchSolutionStatus(id){
    let status = $('#'+id+'-status-text');

    let token = getCsrf();

    $.post(`/${ADMIN_PREFIX}/api/solutions/` + id + '/switch-status', { _token: token }).done(function (data) {
        $(status).text(data.status);
    })
        .fail(function(jqXHR, textStatus, errorThrown){
            getErrorDiv(errorThrown, jqXHR.status)
        });
}

export { switchSolutionStatus };
