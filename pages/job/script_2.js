page_script({
	init: function () {
		$.fn.editable.defaults.ajaxOptions = {type: "POST"};
		$.fn.editable.defaults.type = 'text';
		$.fn.editable.defaults.pk = 1,
		$.fn.editable.defaults.mode = 'inline';
		$.fn.editable.defaults.inputclass = 'form-control';
        $.fn.editable.defaults.url = location.href;
        $.fn.editable.defaults.onblur = 'submit';
        
        $('.editable').editable();

        $(".map-canvas").each(function () {
        	var myLatlng = new google.maps.LatLng($(this).attr("data-latitude"), $(this).attr("data-longitude"));
			var mapOptions = {
				scrollwheel: false,
			  	zoom: 13,
			  	center: myLatlng
			}
			var map = new google.maps.Map($(this)[0], mapOptions);
			var marker = new google.maps.Marker({
			    position: myLatlng
			});
			marker.setMap(map);
        });
	}
});
