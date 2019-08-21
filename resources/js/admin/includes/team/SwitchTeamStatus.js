import {getCsrf} from "../adminTables";

function switchTeamStatus(id){
    let status = $('#'+id+'-status-text');

    let token = getCsrf();

    $.post(`/${ADMIN_PREFIX}/api/team/` + id + '/switch-status', { _token: token }).done(function (data) {
        $(status).text(data.status);
    })
        .fail(function(jqXHR, textStatus, errorThrown){
            getErrorDiv(errorThrown, jqXHR.status)
        });
}

export { switchTeamStatus };
