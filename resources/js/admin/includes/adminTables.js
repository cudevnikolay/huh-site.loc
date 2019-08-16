const processing_img = "<svg style=\"width: 64px;height: 64px;fill: #004288;stroke: #004288\" viewBox=\"0 0 64 64\"><g><circle cx=\"16\" cy=\"32\" stroke-width=\"0\"><animate attributeName=\"fill-opacity\" dur=\"750ms\" values=\".5;.6;.8;1;.8;.6;.5;.5\" repeatCount=\"indefinite\"></animate><animate attributeName=\"r\" dur=\"750ms\" values=\"3;3;4;5;6;5;4;3\" repeatCount=\"indefinite\"></animate></circle><circle cx=\"32\" cy=\"32\" stroke-width=\"0\"><animate attributeName=\"fill-opacity\" dur=\"750ms\" values=\".5;.5;.6;.8;1;.8;.6;.5\" repeatCount=\"indefinite\"></animate><animate attributeName=\"r\" dur=\"750ms\" values=\"4;3;3;4;5;6;5;4\" repeatCount=\"indefinite\"></animate></circle><circle cx=\"48\" cy=\"32\" stroke-width=\"0\"><animate attributeName=\"fill-opacity\" dur=\"750ms\" values=\".6;.5;.5;.6;.8;1;.8;.6\" repeatCount=\"indefinite\"></animate><animate attributeName=\"r\" dur=\"750ms\" values=\"5;4;3;3;4;5;6;5\" repeatCount=\"indefinite\"></animate></circle></g></svg>";

const blur = '0.7';

function saveTableSizeToCookies(table, cookieName) {
    table.on('length.dt', function (e, settings, len) {
        setCookieCount(cookieName, len);
    });
}

function blurTableWhenLoad(table) {
    table.on('processing.dt', function (e, settings, processing) {
        table.css('opacity', processing ? blur : '1');
    });
}

function getCsrf() {
    return $('meta[name="csrf-token"]').attr('content');
}

function confirmDelete() {
    if (!confirm("Do you really want to delete?")) {
        return false;
    }
}

function getErrorDiv(error, status) {
    reloadIfNoSession(status);
    let errorDiv = $('#ajax-error');
    errorDiv.remove();
    $('#coins_processing').hide();
}

function reloadIfNoSession(status) {
    if (status === 403) {
        location.reload();
    }
}

function getPageLength(cookieName, defaultCount) {
    let cookieCount = getCountFromCookie(cookieName);
    let count = cookieCount ? cookieCount : defaultCount;
    return count;
}

function getCountFromCookie(name) {
    let re = new RegExp(name + "=([^;]+)");
    let value = re.exec(document.cookie);
    let count = (value != null) ? decodeURI(value[1]) : null;
    return count;
}

function setCookieCount(name, count) {
    document.cookie = name + "=" + count;
}

export {
    processing_img,
    getCsrf,
    saveTableSizeToCookies,
    blurTableWhenLoad,
    getPageLength,
    getErrorDiv,
    blur,
    setCookieCount,
};