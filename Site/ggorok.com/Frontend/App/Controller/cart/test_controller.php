<?php
class CartTest_Controller extends GGoRok
{
	function home()
	{
		
		echo $this->Load->View('cart/header.tpl',array(
			'title' => 'GGoRok Cart',
			'metaK' => 'GGoRok',
			'metaD' => 'GGoRok',
			'login_token' => $this->token->login_token(true),
			'Category_HTML' => $this->_Cache->get_cache('Category')['data'],
			'TopSearchCategory_HTML' => $this->_Cache->get_cache('TopSearchCategory')['data']
		));
		
	?>
<script type="text/javascript">
	$(document).ready(function(){
		
		$('#ggorokGrid').ggorokGrid({
			'setHeader' : [
				{'Name' : 'Test','CSS' : 'width:100px'},
				{'Name' : 'Test','CSS' : 'width:100px'},
				{'Name' : 'Test','CSS' : 'width:100px'},
				{'Name' : 'Test','CSS' : 'width:100px'},
				{'Name' : 'Test','CSS' : 'width:100px'},
				{'Name' : 'Test','CSS' : 'width:100px'},
				{'Name' : 'Test','CSS' : 'width:100px'},
				{'Name' : 'Test','CSS' : 'width:100px'},
				{'Name' : 'Test','CSS' : 'width:100px'}
				
				
			],
			'setData' : [
				['1','Test','Test','Test','Test','Test'],
				['2','Test','Test','Test','Test','Test'],
				['3','Test','Test','Test','Test','Test'],
				['4','Test','Test','Test','Test','Test'],
				['5','Test','Test','Test','Test','Test'],
				['6','Test','Test','Test','Test','Test'],
				['7','Test','Test','Test','Test','Test'],
				['8','Test','Test','Test','Test','Test'],
				['9','Test','Test','Test','Test','Test'],
				['11','Test','Test','Test','Test','Test'],
				['12','Test','Test','Test','Test','Test'],
				['<b style="color:red">13</b>','Test','Test','Test','Test','Test'],
				['14','Test','Test','Test','Test','Test'],
				['15','Test','Test','Test','Test','Test'],
				['16','Test','Test','Test','Test','Test'],
				['17','Test','Test','Test','Test','Test'],
				['18','Test','Test','Test','Test','Test'],
				['19','Test','Test','Test','Test','Test'],
				['20','Test','Test','Test','Test','Test'],
				['21','Test','Test','Test','Test','Test'],
				['22','Test','Test','Test','Test','Test'],
				['23','Test','Test','Test','Test','Test'],
				['24','Test','Test','Test','Test','Test'],
				['<b style="color:red">25</b>','Test','Test','Test','Test','Test'],
				['26','Test','Test','Test','Test','Test'],
				['27','Test','Test','Test','Test','Test'],
				['28','Test','Test','Test','Test','Test'],
				['29','Test','Test','Test','Test','Test'],
				['30','Test','Test','Test','Test','Test'],
				['31','Test','Test','Test','Test','Test'],
				['32','Test','Test','Test','Test','Test'],
				['33','Test','Test','Test','Test','Test'],
				['34','Test','Test','Test','Test','Test'],
				['35','Test','Test','Test','Test','Test'],
				['36','Test','Test','Test','Test','Test'],
				['37','Test','Test','Test','Test','Test'],
				['38','Test','Test','Test','Test','Test'],
				['39','Test','Test','Test','Test','Test'],
				['40','Test','Test','Test','Test','Test'],
				
				['41','Test','Test','Test','Test','Test'],
				['42','Test','Test','Test','Test','Test'],
				['43','Test','Test','Test','Test','Test'],
				['44','Test','Test','Test','Test','Test'],
				['45','Test','Test','Test','Test','Test'],
				['46','Test','Test','Test','Test','Test'],
				['47','Test','Test','Test','Test','Test'],
				['48','Test','Test','Test','Test','Test'],
				['49','Test','Test','Test','Test','Test'],
				['50','Test','Test','Test','Test','Test'],
				
				
				['51','Test','Test','Test','Test','Test'],
				['52','Test','Test','Test','Test','Test'],
				['53','Test','Test','Test','Test','Test'],
				['54','Test','Test','Test','Test','Test'],
				['55','Test','Test','Test','Test','Test'],
				['56','Test','Test','Test','Test','Test'],
				['57','Test','Test','Test','Test','Test'],
				['58','Test','Test','Test','Test','Test'],
				['59','Test','Test','Test','Test','Test'],
				['60','Test','Test','Test','Test','Test'],
				['61','Test','Test','Test','Test','Test'],
				['62','Test','Test','Test','Test','Test'],
				['63','Test','Test','Test','Test','Test'],
				['64','Test','Test','Test','Test','Test'],
				['65','Test','Test','Test','Test','Test'],
				['66','Test','Test','Test','Test','Test'],
				['67','Test','Test','Test','Test','Test'],
				['68','Test','Test','Test','Test','Test'],
				['69','Test','Test','Test','Test','Test'],
				['70','Test','Test','Test','Test','Test'],
				['51','Test','Test','Test','Test','Test'],
				['52','Test','Test','Test','Test','Test'],
				['53','Test','Test','Test','Test','Test'],
				['54','Test','Test','Test','Test','Test'],
				['55','Test','Test','Test','Test','Test'],
				['56','Test','Test','Test','Test','Test'],
				['57','Test','Test','Test','Test','Test'],
				['58','Test','Test','Test','Test','Test'],
				['59','Test','Test','Test','Test','Test'],
				['60','Test','Test','Test','Test','Test'],
				['61','Test','Test','Test','Test','Test'],
				['62','Test','Test','Test','Test','Test'],
				['63','Test','Test','Test','Test','Test'],
				['64','Test','Test','Test','Test','Test'],
				['65','Test','Test','Test','Test','Test'],
				['66','Test','Test','Test','Test','Test'],
				['67','Test','Test','Test','Test','Test'],
				['68','Test','Test','Test','Test','Test'],
				['69','Test','Test','Test','Test','Test'],
				['70','Test','Test','Test','Test','Test'],
				['51','Test','Test','Test','Test','Test'],
				['52','Test','Test','Test','Test','Test'],
				['53','Test','Test','Test','Test','Test'],
				['54','Test','Test','Test','Test','Test'],
				['55','Test','Test','Test','Test','Test'],
				['56','Test','Test','Test','Test','Test'],
				['57','Test','Test','Test','Test','Test'],
				['58','Test','Test','Test','Test','Test'],
				['59','Test','Test','Test','Test','Test'],
				['60','Test','Test','Test','Test','Test'],
				['61','Test','Test','Test','Test','Test'],
				['62','Test','Test','Test','Test','Test'],
				['63','Test','Test','Test','Test','Test'],
				['64','Test','Test','Test','Test','Test'],
				['65','Test','Test','Test','Test','Test'],
				['66','Test','Test','Test','Test','Test'],
				['67','Test','Test','Test','Test','Test'],
				['68','Test','Test','Test','Test','Test'],
				['69','Test','Test','Test','Test','Test'],
				['70','Test','Test','Test','Test','Test'],
				['51','Test','Test','Test','Test','Test'],
				['52','Test','Test','Test','Test','Test'],
				['53','Test','Test','Test','Test','Test'],
				['54','Test','Test','Test','Test','Test'],
				['55','Test','Test','Test','Test','Test'],
				['56','Test','Test','Test','Test','Test'],
				['57','Test','Test','Test','Test','Test'],
				['58','Test','Test','Test','Test','Test'],
				['59','Test','Test','Test','Test','Test'],
				['60','Test','Test','Test','Test','Test'],
				['61','Test','Test','Test','Test','Test'],
				['62','Test','Test','Test','Test','Test'],
				['63','Test','Test','Test','Test','Test'],
				['64','Test','Test','Test','Test','Test'],
				['65','Test','Test','Test','Test','Test'],
				['66','Test','Test','Test','Test','Test'],
				['67','Test','Test','Test','Test','Test'],
				['68','Test','Test','Test','Test','Test'],
				['69','Test','Test','Test','Test','Test'],
				['70','Test','Test','Test','Test','Test'],
				['51','Test','Test','Test','Test','Test'],
				['52','Test','Test','Test','Test','Test'],
				['53','Test','Test','Test','Test','Test'],
				['54','Test','Test','Test','Test','Test'],
				['55','Test','Test','Test','Test','Test'],
				['56','Test','Test','Test','Test','Test'],
				['57','Test','Test','Test','Test','Test'],
				['58','Test','Test','Test','Test','Test'],
				['59','Test','Test','Test','Test','Test'],
				['60','Test','Test','Test','Test','Test'],
				['61','Test','Test','Test','Test','Test'],
				['62','Test','Test','Test','Test','Test'],
				['63','Test','Test','Test','Test','Test'],
				['64','Test','Test','Test','Test','Test'],
				['65','Test','Test','Test','Test','Test'],
				['66','Test','Test','Test','Test','Test'],
				['67','Test','Test','Test','Test','Test'],
				['68','Test','Test','Test','Test','Test'],
				['69','Test','Test','Test','Test','Test'],
				['70','Test','Test','Test','Test','Test'],
				['51','Test','Test','Test','Test','Test'],
				['52','Test','Test','Test','Test','Test'],
				['53','Test','Test','Test','Test','Test'],
				['54','Test','Test','Test','Test','Test'],
				['55','Test','Test','Test','Test','Test'],
				['56','Test','Test','Test','Test','Test'],
				['57','Test','Test','Test','Test','Test'],
				['58','Test','Test','Test','Test','Test'],
				['59','Test','Test','Test','Test','Test'],
				['60','Test','Test','Test','Test','Test'],
				['61','Test','Test','Test','Test','Test'],
				['62','Test','Test','Test','Test','Test'],
				['63','Test','Test','Test','Test','Test'],
				['64','Test','Test','Test','Test','Test'],
				['65','Test','Test','Test','Test','Test'],
				['66','Test','Test','Test','Test','Test'],
				['67','Test','Test','Test','Test','Test'],
				['68','Test','Test','Test','Test','Test'],
				['69','Test','Test','Test','Test','Test'],
				['70','Test','Test','Test','Test','Test']
				
				
			]
		});
		
		
	});

	(function($){
		$.fn.ggorokGrid = function(E = {}) {
			var self = this;
			this.gridData = {};
			this.gridWidth = 0;
			this.gridHeight = 0;
			this.oneHeight = 0;
			this.GridObj = $(this);
			this.displayableRows = 0;
			this.displayableHeight = 0;
			this.ID_Rnd = $('.ggorokGrid').length + 1;
			this.displayIndex = 0;
			this.amIDown = false;
			this.init = function(){
				
				if(E.hasOwnProperty('setHeader'))
				{
					self.setHeader();
				}
				
				if(E.hasOwnProperty('setData'))
				{
					self.setData();
				}
				
				
				
			};
			
			this.setData = function(){
				self.gridData = E.setData;
			};
			this.setHeader = function(){
				var HTML = '';
				
				E.setHeader.forEach(function(Row,index,array){
					HTML += '<div class="GGRH_One"'+(Row.hasOwnProperty('CSS') ? 'style="'+Row.CSS+'"' : '')+'>'+Row.Name+'</div>';
				});
				
				HTML = '<div class="GGR_Header">' + HTML +'</div>';
				$(this).append(HTML);
				
				$(this).find('.GGRH_One').each(function(){
					self.gridWidth = self.gridWidth + $(this).outerWidth();
				});
				
				$(this).find('.GGR_Header').css("width", self.gridWidth+"px");
				
			};
			this.drawGrid = function(){
				self.oneHeight = $(this).find('.GGR_Header').outerHeight();
				self.gridHeight = self.oneHeight * self.gridData.length;

				$(this).append('<div class="gridContainer" id="gridContainer_'+self.ID_Rnd+'"">'+
										'<div class="gridWrap" id="gridWrap_'+self.ID_Rnd+'" style="width:'+self.gridWidth+'px;height:'+self.gridHeight+'px">'+
											'<table id="GridStage_'+self.ID_Rnd+'">'+
												'<tr><td id="Guider_'+self.ID_Rnd+'" class="Guider" colspan="1000000"></td></tr>'+
											'</table>'+
										'</div>'+
									'</div>');
				
				self.displayableRows = Math.round($(this).height() / self.oneHeight);
				self.displayableHeight = self.displayableRows * self.oneHeight;
				self.drawData(self.displayIndex,(self.displayableRows * 2),true,true);
				self.displayIndex = self.displayableRows;
				
				$('#gridContainer_' + self.ID_Rnd).scroll(function(){
					
					
					if($(this).scrollTop() - $("#Guider_"+self.ID_Rnd).outerHeight()  > (self.displayableHeight / 2) && !self.amIDown)
					{
						self.amIDown = true;
						$("#Guider_"+self.ID_Rnd).height($(this).scrollTop());
						console.log('Down');
					}
					else if($(this).scrollTop() - $("#Guider_"+self.ID_Rnd).outerHeight() < (self.displayableHeight / 2) && self.amIDown)
					{
						
						$("#Guider_"+self.ID_Rnd).height($(this).scrollTop());
						self.amIDown = false;
						console.log('Up');
					}
					/*
					
					if($(this).scrollTop() > TableBottonPosition && TableBottonPosition < $('#gridContainer_' + self.ID_Rnd).scrollHeight)
					{
						$("#Guider_"+self.ID_Rnd).height($(this).scrollTop());
						console.log(1);
						//self.displayIndex = 10;
					}
					else if($(this).scrollTop() < ($("#Guider_"+self.ID_Rnd).outerHeight() + self.displayableHeight))
					{
						
					}
					//$("#Guider_"+self.ID_Rnd).outerHeight() + (displayableRows * self.oneHeight)
					/*
					console.log($(this).scrollTop() + "/" + ( $("#Guider_"+self.ID_Rnd).outerHeight() + (displayableRows * self.oneHeight)));
					if($(this).scrollTop() > ($("#Guider_"+self.ID_Rnd).outerHeight() + (displayableRows * self.oneHeight)))
					{
						self.GridObj.find('.Guider').css("height",$(this).scrollTop()+"px");
					}
					//*/
					
				});
				
				//overflow:auto;
			};
			
			this.drawData = function(From,To,InsertBottom = true, Init = false){
				if((self.displayableRows * 2) <= self.gridData.length)
				{
					for(From ; From < To ; From++)
					{
						var HTML = "";
						HTML += '<tr data-rid="'+From+'">';
						HTML += 	'<td>'+self.gridData[From]+'</td>';
						HTML += '</tr>';
						
						
						if(InsertBottom)
						{
							
							$("#GridStage_"+self.ID_Rnd).append(HTML);
						}
						else
						{
							$("#GridStage_"+self.ID_Rnd).prepend(HTML);
						}
						
					}
					
				}
			};
			
			
			self.init();
			self.drawGrid();
		};
		
		/*
		$.fn.ggorokGrid.prototype = {
			setData : function(){
				
			}
		};
		*/
	
	})(jQuery);
	
</script>
<style type="text/css">
	.ggorokGrid {position:relative;}
	.ggorokGrid .gridContainer{width:100%;height:100%;overflow:auto;position:relative}
	.ggorokGrid table{position:absolute;left:0;top:0;}
	.ggorokGrid td{border:1px solid gray;padding:5px;}
	.ggorokGrid .Guider{border:0px!important;padding:0!important;}
	
	
	
</style>
<div id="ggorokGrid" class="ggorokGrid" style="width:300px;height:300px;overflow:hidden;"></div>
	<?
	}
}