require('./bootstrap');
require("flatpickr");
import { Romanian } from "flatpickr/dist/l10n/ro.js"

(function($) {
    $.QueryString = (function(paramsArray) {
        let params = {};

        for (let i = 0; i < paramsArray.length; ++i) {
            let param = paramsArray[i].split('=', 2);

            if (param.length !== 2)
                continue;

            params[param[0]] = decodeURIComponent(param[1].replace(/\+/g, " "));
        }

        return params;
    })(window.location.search.substr(1).split('&'))
})(jQuery);

(function($) {
    $.SetQueryStringParameter = function(parameter, value) {
        let filters = $.QueryString;

        if ('' === value) {
            delete filters[parameter];
        } else {
            filters[parameter] = value;
        }

        let queryString = Object.keys(filters).map(key => key + '=' + filters[key]).join('&');
        let historyUrl = location.pathname + '?' + queryString;

        history.replaceState(null, null, historyUrl);
    }
})(jQuery);

(function($) {
    $.TranslateRequestStatus = function(status) {
        switch (status) {
            case 'new':
                return 'Nouă';
            case 'in-progress':
                return 'În progres';
            case 'completed':
                return 'Finalizată';
            default:
                return status;
        }
    }
})(jQuery);

$(document).ready(function () {
    flatpickr('.flatpickr-h4h', {
        "locale": Romanian // TODO @argon
    });

    //Sidebar on admin
    $("#sidebar-collapse").click(function(){
        $(".admin-area").toggleClass("sidebar-visible");
    });
});
