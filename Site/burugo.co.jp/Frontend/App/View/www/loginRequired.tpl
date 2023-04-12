<style type="text/css">
	.centerNotice{padding:30px;width:300px;height:70px;border-radius:30px;background-color:#f0f0f0;text-align:center;line-height:20px;color:#505050;border:5px dotted #cacaca;position:absolute;left:50%;top:50%;margin-left:-150px;margin-top:-35px;}
</style>
<script type="text/javascript">
	$(document).ready(function(){
		Common.loginRequired();
	});
</script>
<?php echo $this->Load->View('www/inc/left_tab.tpl',array("PG"=>"Home"));?>
<script type="text/javascript">
	LoginRefresh = true;
</script>
<div class="Front_Contents_Body">
	<div class="centerNotice"><?php echo $this->_Lang_www_loginRequired['login_required'];?></div>
</div>