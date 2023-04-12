<style type="text/css">
	#See_List_Btn{display:block;background-color:white;z-index:100;position:absolute;right:50px;bottom:23px;font-size:20px;padding:13px;border:1px solid #8c8c8c;border-radius:5px;}
	#See_List_Btn:hover{background-color:#efefef;}
</style>
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		Map.init();
		
	
	});
	
	var Map = new function(){
		this.map;
		this.lat = '37.498410';
		this.lng = '127.026838';
		
		this.init = function(){
			var self = this;
			var mapCanvas = document.getElementById('MapView');
			var mapOptions = {
				center: new google.maps.LatLng(this.lat, this.lng),
				zoom: 15,
				scrollwheel: false,
				mapTypeControl: false,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			self.map = new google.maps.Map(mapCanvas, mapOptions);
			
			refreshPage.Callback = function(res){
				
				if(res.ack == 'success')
				{
					for(Key in res.Result)
					{
						if(res.Result.hasOwnProperty(Key))
						{
							var Icon = '/Template/Img/';
							
							if(res.Result[Key]['T'] == 1)
								Icon += 'map-marker-business.png';
							else if(res.Result[Key]['T'] == 2)
								Icon += 'map-marker-friend.png';
							else if(res.Result[Key]['T'] == 3)
								Icon += 'map-marker-helper.png';
								
							
							var marker = new google.maps.Marker({
								position: new google.maps.LatLng(res.Result[Key]['Lat'], res.Result[Key]['Lon']),
								animation: google.maps.Animation.DROP,
								map: self.map,
								url: res.Result[Key]['U'],
								icon: Icon
							});
							google.maps.event.addListener(marker, 'click', function() {
								window.location.href = this.url;
							});
						}
					}
					self.goGPSLocation();
					
				}
			};
			refreshPage.Submit();
			
			this.goGPSLocation = function(){
				var self = this;
				if (navigator.geolocation)
				{
					navigator.geolocation.getCurrentPosition(function(position)
					{
						var pos = {
							lat: position.coords.latitude,
							lng: position.coords.longitude
						};
				
						self.map.setCenter(pos);
						window.location.href = '#Lat='+position.coords.latitude+'&Lng='+position.coords.longitude;
					}, function() {
						handleLocationError(true, infoWindow, map.getCenter());
					});
				}
				else
				{
					/*Browser doesn't support Geolocation*/
					handleLocationError(false, infoWindow, map.getCenter());
				}
			};
		};
	};
</script>
<?php echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"AroundMe"));?>
<a id="See_List_Btn" href="/Lists"><i class="fa fa-th"></i> <?php echo $this->_Lang_www_AroundMe['view_list'];?></a>
<div id="MapView" class="Front_Contents_Body"></div>
<div id="ListView"></div>