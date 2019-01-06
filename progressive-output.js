if (window.hasOwnProperty('jQuery') && typeof window.jQuery === 'function') {
    (function ($) {
        var output, lastResponseLength = -1;

        function outputFinished() {
            output.val(output.val() + 'completed!\n\n');
        }

        function progressiveOutput(e) {
            var response, parsed;
            if (lastResponseLength < 0) {
                response = e.target.responseText;
                lastResponseLength = response.length;
            } else {
                response = e.target.responseText.substring(lastResponseLength);
                lastResponseLength = e.target.responseText.length;
            }
            parsed = JSON.parse(response);
            if (parsed.success) {
                output.val(output.val() + parsed.data.message + ': ' + parsed.data.count + '\r\n');
                output.animate({
                    scrollTop: output.prop('scrollHeight')
                }, 500);
            }
        }

        $(document).ready(function () {
            output = $('#progressive-output-output-area');
            $('#progressive-output-test').on('click', function () {
                lastResponseLength = -1;
                output.val('');
                if (window.hasOwnProperty('ajaxurl')) {
                    $.ajax(window.ajaxurl, {
                        method: 'get',
                        data: {action: 'request-progressive-output'},
                        success: outputFinished,
                        dataType: 'text',
                        xhrFields: {
                            onprogress: progressiveOutput
                        }
                    });
                }
            });
        });
    })(window.jQuery);
} else {
    throw 'jQuery is not defined!';
}
