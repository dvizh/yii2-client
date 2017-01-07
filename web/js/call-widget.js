if (typeof pistol88 == "undefined" || !pistol88) {
    var pistol88 = {};
}

pistol88.callWidget = {
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

pistol88.callWidget.init();
