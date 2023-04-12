<script type="text/javascript" src="/Core/JS/w2ui/w2ui.min.js"></script>

<script type="text/javascript">
	var people = [
    { id: 1, text: 'John Cook' },
    { id: 2, text: 'Steve Jobs' },
    { id: 3, text: 'Peter Sanders' },
    { id: 4, text: 'Mark Newman' },
    { id: 5, text: 'Addy Osmani' },
    { id: 6, text: 'Paul Irish' },
    { id: 7, text: 'Doug Crocford' },
    { id: 8, text: 'Nicolas Cage' }
];
	
	$(document).ready(function(){
		GMEditor.init();
		$(document).on(touchOrClick,"#Print_BTN",function(){
			window.print();
		});
		
		
		$('#GM_Table_Grid').w2grid({ 
			name: 'grid',
			url : {
				get : '/corp/modules/google-merchant/?ajaxProcess&menu=getGridData',
				save : '/corp/modules/google-merchant/?ajaxProcess&menu=saveGridData'
			},			
        
			show: { 
				toolbar: true,
				footer: true,
				toolbarSave: true
			},
			searchable     : true,
			searches : [
				{field: 'recid', caption: 'Item ID(int)', type:'int'}
			],
			columns: [
				{ field: 'recid', caption: 'Item ID', size: '70px', sortable: true, resizable: true, style: 'text-align: center'},
				{ field: 'onOff', caption: 'On/Off', size: '70px', sortable: true, resizable: true, style: 'text-align: center',
					editable: { type: 'checkbox', style: 'text-align: center' } 
				},
				{ field: 'title', caption: 'Title on AD', size: '300px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'description', caption: 'Description on AD', size: '300px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'condition', caption: 'condition', size: '70px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'price', caption: 'price', size: '100px', sortable: true, resizable: true},
				{ field: 'availability', caption: 'availability', size: '100px', sortable: true, resizable: true},
				{ field: 'link', caption: 'Link', size: '370px', sortable: true, resizable: true},
				{ field: 'mpn', caption: 'mpn', size: '100px', sortable: true, resizable: true},
				{ field: 'image_link', caption: 'image_link', size: '370px', sortable: true, resizable: true},
				{ field: 'additional_image_link', caption: 'additional_image_link', size: '150px', sortable: true, resizable: true},
				{ field: 'gtin', caption: 'gtin', size: '100px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'brand', caption: 'brand', size: '100px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'google_product_category', caption: 'google_product_category', size: '200px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'material', caption: 'material', size: '100px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'item_group_id', caption: 'item_group_id', size: '100px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'shipping_weight', caption: 'weight', size: '100px', sortable: true, resizable: true},
				{ field: 'sale_price_effective_date', caption: 'sale_price_effective_date', size: '100px', sortable: true, resizable: true},
				{ field: 'product_type', caption: 'product_type', size: '200px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'custom_label_0', caption: 'custom_label_0', size: '200px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'custom_label_1', caption: 'custom_label_1', size: '200px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'custom_label_2', caption: 'custom_label_2', size: '200px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'custom_label_3', caption: 'custom_label_3', size: '200px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				{ field: 'custom_label_4', caption: 'custom_label_4', size: '200px', sortable: true, resizable: true,
					editable: { type: 'text' }
				},
				
				/*
            { field: 'recid', caption: 'ID', size: '50px', sortable: true, resizable: true },
            { field: 'text', caption: 'text', size: '120px', sortable: true, resizable: true, 
                editable: { type: 'text' }
            },
            { field: 'int', caption: 'int', size: '80px', sortable: true, resizable: true, render: 'int',
                editable: { type: 'int', min: 0, max: 32756 }
            },
            { field: 'money', caption: 'money', size: '80px', sortable: true, resizable: true, render: 'money',
                editable: { type: 'money' }
            },
            { field: 'percent', caption: 'percent', size: '80px', sortable: true, resizable: true, render: 'percent:1', 
                editable: { type: 'percent', precision: 1 } 
            },
            { field: 'color', caption: 'color', size: '80px', sortable: true, resizable: true, 
                editable: { type: 'color' }
            },
            { field: 'date', caption: 'date', size: '90px', sortable: true, resizable: true, render: 'date', style: 'text-align: right',
                editable: { type: 'date' } 
            },
            { field: 'time', caption: 'time', size: '70px', sortable: true, resizable: true, 
                editable: { type: 'time' } 
            },
            { field: 'list', caption: 'list', size: '50%', sortable: true, resizable: true, 
                editable: { type: 'list', items: people, showAll: true },
                render: function (record, index, col_index) {
                    var html = this.getCellValue(index, col_index);
                    return html || '';
                }
            },
            { field: 'combo', caption: 'combo', size: '50%', sortable: true, resizable: true, 
                editable: { type: 'combo', items: people, filter: false } 
            },
            { field: 'select', caption: 'select', size: '100px', sortable: true, resizable: true, 
                editable: { type: 'select', items: [{ id: '', text: '' }].concat(people) }, 
                render: function (record, index, col_index) {
                    var html = '';
                    for (var p in people) {
                        if (people[p].id == this.getCellValue(index, col_index)) html = people[p].text;
                    }
                    return html;
                }
            },
            { field: 'check', caption: 'check', size: '60px', sortable: true, resizable: true, style: 'text-align: center',
                editable: { type: 'checkbox', style: 'text-align: center' } 
            }
            */
			]
			/*,
			toolbar: {
				items: [
					{ id: 'add', type: 'button', caption: 'Add Record', icon: 'w2ui-icon-plus' }
				],
				onClick: function (event) {
					if (event.target == 'add') {
						w2ui.grid.add({ recid: w2ui.grid.records.length + 1 });
					}
				}
			}
			*/
			/*,
        records: [
            { recid: 1, onOff: "100", itemName: "100", itemDescription: "55" },
				{ recid: 2, onOff: "100", itemName: "101", itemDescription: "52" }
				
				
            { recid: 2, int: 200, money: 454.40, percent: 15, date: '1/1/2014', combo: 'John Cook', check: false, list: { id: 2, text: 'Steve Jobs' } },
            { recid: 3, int: 350, money: 1040, percent: 98, date: '3/14/2014', combo: 'John Cook', check: true },
            { recid: 4, int: 350, money: 140, percent: 58, date: '1/31/2014', combo: 'John Cook', check: true, list: { id: 4, text: 'Mark Newman' } },
            { recid: 5, int: 350, money: 500, percent: 78, date: '4/1/2014', check: false },
            { recid: 6, text: 'some text', int: 350, money: 440, percent: 59, date: '4/4/2014', check: false },
            { recid: 7, int: 350, money: 790, percent: 39, date: '6/8/2014', check: false },
            { recid: 8, int: 350, money: 4040, percent: 12, date: '11/3/2014', check: true },
            { recid: 9, int: 1000, money: 3400, percent: 100, date: '2/1/2014',
                style: 'background-color: #ffcccc', editable: false }
              
        ]
       */
		});
	});
	
	var GMEditor = new function(){
		
		var OnAD_TXT = 'This item is now showing on AD';
		var OffAD_TXT = 'Deactivated';
		
		
		this.init = function(){
			$(document).on('change','input',function(){
				$(this).addClass('hasChanged');
			});
			
		
			$.ajax({
				type: "POST",
				url: '?ajaxProcess',
				data: "menu=getFeed&Data=",
				success: function(d){
					
				}
			});
			
			$(document).on(touchOrClick,'.CL_ADPowerBTN',function(){
				$(this).addClass('hasChanged');
				if($(this).hasClass('ADOn'))
				{
					$(this).removeClass('ADOn');
					$(this).addClass('ADOff');
				}
				else
				{
					$(this).removeClass('ADOff');
					$(this).addClass('ADOn');
					
					
				}
			});
			
			
		};
	};
</script>
<style type="text/css">
	
	#PG_Menu{float:right;}
	#PG_Contents{position:absolute;left:0;top:65px;right:0;bottom:0;}
	#GM_Table_Grid div{float:none;}
	#GM_Table_Grid .w2ui-col-header{text-align:center;}
	#GM_Table{border:1px solid gray;}
	#GM_Table th{background-color:#f2f2f2;padding-left:10px;padding-right:10px;}
	#GM_Table th,#GM_Table td{white-space: nowrap;border-right:1px solid gray;border-bottom:1px solid gray;line-height:20px;font-weight:normal;}
	#GM_Table td div{height:22px;width:100%;}
	#GM_Table .CL_Title div{width:300px;}
	#GM_Table .CL_Desc div{width:300px;overflow:hidden;}
	#GM_Table .CL_ADPower div{div:50px;text-align:center;}
	#GM_Table .CL_ADPower .ADOff{background-color:#9c9c9c;color:#00324c;}
	#GM_Table .CL_ADPower .ADOn{background-color:#7bc1e6;color:#00324c;}
	#GM_Table .hasInput{width:100%;}
	
	#GM_Table .noInput{text-align:center;padding-left:10px;padding-right:10px;background-color:#e1e1e1;width:100%;box-sizing:border-box;}
	#GM_Table input.hasChanged{background-color:#ffe9a7;}
	#GM_Table input{text-align:center;width:100%;border:0;padding:0 10px 0 10px;margin:0px;box-sizing:border-box;line-height:20px;height:20px;}
	#GM_Table input:focus{background-color:#ffebbb;border:0;outline:none;}
	#GM_Table input:hover{background-color:#d9f1ff;}
	
	.disabledItem{background-color:#ffbcbc!important;}
	.outOfStock{background-color:#fee6ff!important;}
	.CL_Col{cursor:pointer;}
	.OnAd{width:100%;height:20px;line-height:20px;}
	.OnNoAD_Block{position:absolute;overflow:hidden;top:0;bottom:0;overflow:auto;box-sizing:border-box;padding:20px;left:0;right:0}
	#GM_Table_Grid{width:100%;height:100%;}
</style>
<link rel="stylesheet" type="text/css" href="/Core/JS/w2ui/w2ui.min.css" />

<h2 id="PG_Title">
	<i class="fa fa-google-plus-circle"></i> Google Merchant
</h2>

<div id="PG_Menu">
	<div id="Print_BTN" data-tooltip="Print this page" class="Glow button button_white"><i id="UploadingIcon" class="fa fa-print"></i></div>
	<div id="Refresh_BTN" class="button button_gray" data-tooltip="Refresh"><i class="fa fa-rotate-left"></i></div>
</div>

<div id="PG_Contents">
	<div id="OnAd_Block" class="OnNoAD_Block">
		<div id="GM_Table_Grid"></div>
		
			<?php
			
			/*
				foreach($List['OnAD'] AS $_K => $_F)
				{
				
					if($_F['GM_google_merchant_status'] == 1)
					{
					//'<td class="CL_Avl"><div>'.(isset($_F['products_quantity']) && $_F['products_quantity'] > 0 ? $_F['GM_condition'] : '').'</div></td>'.
					?>
						<tr class="OnAd noSelect" data-prdid="<?php echo $_F['Prd_ID'];?>">
							<td class="CL_Col CL_ADPower"><div class="CL_ADPowerBTN <?php echo ($_F['GM_google_merchant_status'] == 0 ? 'ADOff' : 'ADOn')?>"><i class="fa fa-power-off"></i></div></td>
							<td class="CL_Col CL_ID"><div class="noInput<?php echo ($_F['products_status'] == 0 ? ' disabledItem" data-tooltip="This item is not on sale now.' : '');?>"><?php echo $_F['Prd_ID'];?></div></td>
							<td class="CL_Col CL_Title"><div class="hasInput"><input data-id="GM_title" value="<?php echo htmlspecialchars($_F['GM_title']);?>" /></div></td>
							<td class="CL_Col CL_Desc"><div class="hasInput"><input data-id="GM_description" value="<?php echo htmlspecialchars($_F['GM_description']);?>" /></div></td>
							<td class="CL_Col CL_CDT"><div class="hasInput"><input data-id="GM_condition" value="<?php echo htmlspecialchars($_F['GM_condition']);?>" /></div></td>
							<td class="CL_Col CL_Price"><div class="noInput">$<?php echo number_format($_F['products_price'],2);?></div></td>
							<td class="CL_Col CL_Avl"><div class="noInput<?php echo ($_F['products_quantity'] > 0 ? '' : ' outOfStock ');?>"><?php echo ($_F['products_quantity'] > 0 ? 'in stock' : 'out of stock');?></div></td>
							<td class="CL_Col CL_Link"><div class="noInput"><a href="http://www.janilink.com/product_info.php?products_id=<?php echo $_F['products_id'];?>">http://www.janilink.com/product_info.php?products_id=<?php echo $_F['products_id'];?></a></div></td>
							<td class="CL_Col CL_MPN"><div class="noInput"><?php echo htmlspecialchars($_F['products_model']);?></div></td>
							<td class="CL_Col CL_ImgLnk"><div class="noInput"><a href="https://www.janilink.com/img/p/O/<?php echo $_F['products_image'];?>">https://www.janilink.com/img/p/O/<?php echo $_F['products_image'];?></a></div></td>
							<td class="CL_Col CL_ImgLnkAdd"><div class="noInput"></div></td>
							<td class="CL_Col CL_GTIN"><div class="hasInput"><input data-id="GM_gtin" value="<?php echo htmlspecialchars($_F['GM_gtin']);?>" /></div></td>
							<td class="CL_Col CL_Brand"><div class="hasInput"><input data-id="GM_brand" value="<?php echo htmlspecialchars($_F['GM_brand']);?>" /></div></td>
							<td class="CL_Col CL_GPCat"><div class="hasInput"><input data-id="GM_google_product_category" value="<?php echo htmlspecialchars($_F['GM_google_product_category']);?>" /></div></td>
							<td class="CL_Col CL_Mat"><div class="hasInput"><input data-id="GM_material" value="<?php echo $_F['GM_material'];?>" /></div></td>
							<td class="CL_Col CL_GID"><div class="hasInput"><input data-id="GM_item_group_id" value="<?php echo $_F['GM_item_group_id'];?>" /></div></td>
							<td class="CL_Col CL_Weight"><div class="noInput"><?php echo $_F['products_weight'];?></div></td>
							<td class="CL_Col CL_AffDate"><div class="hasInput"><input data-id="GM_addfate" value="" /></div></td>
							<td class="CL_Col CL_PType"><div class="hasInput"><input data-id="GM_product_type" value="<?php echo $_F['GM_product_type'];?>" /></div></td>
							<td class="CL_Col CL_Lbl0"><div class="hasInput"><input data-id="GM_custom_label_0" value="<?php echo $_F['GM_custom_label_0'];?>" /></div></td>
							<td class="CL_Col CL_Lbl1"><div class="hasInput"><input data-id="GM_custom_label_1" value="<?php echo $_F['GM_custom_label_1'];?>" /></div></td>
							<td class="CL_Col CL_Lbl2"><div class="noInput"><?php echo $_F['products_model'];?></div></td>
							<td class="CL_Col CL_Lbl3"><div class="hasInput"><input data-id="GM_custom_label_3" value="<?php echo $_F['GM_custom_label_3'];?>" /></div></td>
							<td class="CL_Col CL_Lbl4"><div class="hasInput"><input data-id="GM_custom_label_4" value="<?php echo $_F['GM_custom_label_4'];?>" /></div></td>
						</tr>
					<?
					
				}
			}
			*/
				
				
			
			?>
			
		
	</div>
	
</div>