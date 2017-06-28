if (typeof dvizh == "undefined" || !dvizh) {
    var dvizh = {};
}

dvizh.callWidget = {
    init: function() {
        $('#call-widget-add-form').on('submit', this.sendForm)
    },
    sendForm: function() {
        var form = $(this);
		$(form).css('opacity', '0.3');
		$.post(
			$(form).attr('action'),
			$(form).serialize(),
            function(answer) {
                $(form).css('opacity', '1');
				var json = $.parseJSON(answer);
                if(json.result == 'success') {
					$('.call-to-client-widget .modal').modal('hide');
                    $('.client-calls-update').click();
                }
                else {
                    alert('Error');
                }
            }
        );
        
        return false;
    }
};

dvizh.callWidget.init();
