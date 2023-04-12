<style type="text/css">
	.TP_Left{background-color:#f2f2f2;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		$("#Language_SLT").GGoRokSelect({
			'onSelect' : function(O){
				$.ajax({
					type: "POST",
					url: __AjaxURL__+"?ajaxProcess&langSetting",
					data: "langID="+O.Value,
					success: function(d){
						location.reload();
					}
				});
			},
			'initValue' : <?php echo __langID__;?>
		});
		
		$("#GPS_SLT").GGoRokSelect(function(){
			
		});
		
		$("#RelatedK_SLT").GGoRokSelect(function(){
			
		});
	});
</script>
<?php echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"Setting"));?>
<div class="TP_Left">
	<h1><?php echo $this->_Lang_www_Setting['TXT_PageHeader'];?></h1>
	<h2><?php echo $this->_Lang_www_Setting['TXT_PageHeader_Desc'];?></h2>
	<hr />
	<h3><?php echo $this->_Lang_www_Setting['default_lang'];?></h3>
	<div id="Language_SLT" class="SLT_Box clearB noSelect" data-value="1">
		<div class="SLT_Selected">
			<div class="SLT_Selected_Text">한국어 (Korean)</div>
			<i class="fa fa-caret-down SLT_DropDown"></i>
		</div>
		<div class="SLT_Lists">
			<div data-value="1" class="SLT_List_One Glow">한국어 (Korean)</div>
			<?php //<div data-value="2" class="SLT_List_One Glow">English</div>?>
			<div data-value="3" class="SLT_List_One Glow">日本語 (Japanese)</div>
			<?php //<div data-value="4" class="SLT_List_One Glow">繁體中文 (Chinese)</div>?>
		</div>
	</div>
	
	<h3><?php echo $this->_Lang_www_Setting['related_key'];?></h3>
	<div id="RelatedK_SLT" class="SLT_Box clearB noSelect">
		<div class="SLT_Selected">
			<div data-value="1" class="SLT_List_One"><?php echo $this->_Lang_general['use'];?></div>
			<i class="fa fa-caret-down SLT_DropDown"></i>
		</div>
		<div class="SLT_Lists">
			<div data-value="1" class="SLT_List_One Glow"><?php echo $this->_Lang_general['use'];?></div>
			<div data-value="0" class="SLT_List_One Glow"><?php echo $this->_Lang_general['not_use'];?></div>
		</div>
	</div>
	
	<h3><?php echo $this->_Lang_www_Setting['use_gps'];?></h3>
	<div id="GPS_SLT" class="SLT_Box clearB noSelect">
		<div class="SLT_Selected">
			<div data-value="1" class="SLT_List_One"><?php echo $this->_Lang_general['use'];?></div>
			<i class="fa fa-caret-down SLT_DropDown"></i>
		</div>
		<div class="SLT_Lists">
			<div data-value="1" class="SLT_List_One Glow"><?php echo $this->_Lang_general['use'];?></div>
			<div data-value="0" class="SLT_List_One Glow"><?php echo $this->_Lang_general['not_use'];?></div>
		</div>
	</div>
	
</div>