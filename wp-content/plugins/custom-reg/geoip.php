<?php
function add_geo_script_in_footer() {
    echo "
    	<script>
			function geolocationController(){
			var ip = '{$_SERVER['REMOTE_ADDR']}';
			var needgeoip = true;
			var mycoords = [];
			var city = '';

			this.init = function(){
				geoip();
				browip();
			}

			var geoip = function(){
				
						jQuery.ajax({
							url:'https://freegeoip.net/json/'+ip,
						        dataType : 'jsonp',
						        crossDomain:true,
							complete: function(data2){
								console.log(data2);
								if(needgeoip){
									var json = data2.responseJSON;
									mycoords[0] = json.latitude;
									mycoords[1] = json.longitude;
									getCity();
								}
							}
						});
					
			};
			var browip = function(){
				if(navigator.geolocation) {
					navigator.geolocation.getCurrentPosition(function(position) {
						mycoords[0] = position.coords.latitude;
						mycoords[1] = position.coords.longitude;
						needgeoip = false;
						getCity();
					});
				}
			};
			var getCity = function(){
				jQuery.ajax({
					url: 'http://maps.googleapis.com/maps/api/geocode/json?language=en&latlng='+mycoords.join(','),
				        dataType : 'text',
				        crossDomain:true,
					complete:function(data){
						var json = JSON.parse(data.responseText);
						for(var i = 0; i<json.results.length;i++){
							if(find(json.results[i].types,'locality')>=0)
								for (var j = 0; j<json.results[i].address_components.length; j++) {
									if(find(json.results[i].address_components[j].types,'locality')>=0){
										city = json.results[i].address_components[j].long_name;
										drawCity();
										return false;
									}
								}
						}
					}
				});
			}
			var drawCity = function(){
				jQuery('#search_location').val(city);
			}
			var find = function(array, value) {
				for (var i = 0; i < array.length; i++) {
				    if (array[i] == value) return i;
				}
				return -1;
			}

		}
		var geolocation = new geolocationController();
		setTimeout(geolocation.init,1000);
		</script>
    ";
}
add_action( 'wp_print_scripts', 'add_geo_script_in_footer');