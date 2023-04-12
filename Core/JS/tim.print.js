function printReceipt(Post)
{
	
	
	var strFrameName = ("printer-" + (new Date()).getTime());
	var jFrame = $( "<iframe src='/print-receipt/?"+Post+"' name=" + strFrameName + "'>" );
	
	jFrame
		.css( "width", "1px" )
		.css( "height", "1px" )
		.css( "position", "absolute" )
		.css( "left", "-9999px" )
		.appendTo( $( "body:first" ) )
	;
	
	/*
	var objFrame = window.frames[ strFrameName ];
	var objDoc = objFrame.document;

	objDoc.open();
	objDoc.close();
*/

	setTimeout(
		function(){
			jFrame.remove();
			
		},
		(60 * 1000)
	);
}