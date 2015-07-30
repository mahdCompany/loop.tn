page_script({
	init: function () {

		$("#message_form").ajaxForm({
			beforeSubmit: function () {
				$(".success_msg", $("#message_form")).hide();
				$(".unhandled_error", $("#message_form")).hide();
			},
			success: function (rslt) {
				try{
          parsed=JSON.parse(rslt);
          if (parsed.status == "success") {
          	$(".success_msg", $("#message_form")).show();
						$("#message_form")[0].reset();
      		} else {
          	console.log(rslt);
            $(".unhandled_error", $("#message_form")).show();
          }
	      }catch(ex){
	        console.log(rslt);
	        $(".unhandled_error", $("#message_form")).show();
	      }
			}
		});
		$("#message_modal").on("hide.bs.modal", function () {
			$("#message_form")[0].reset();
			$(".success_msg", $("#message_form")).hide();
			$(".unhandled_error", $("#message_form")).hide();
		});

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

		window.fbAsyncInit();
	}
});
