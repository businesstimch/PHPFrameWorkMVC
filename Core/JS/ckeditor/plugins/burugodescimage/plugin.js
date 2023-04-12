CKEDITOR.plugins.add( 'burugodescimage', {

	// Register the icons. They must match command names.
	icons: 'burugodescimage',

	// The plugin initialization logic goes inside this method.
	init: function( editor ) {

		// Define the editor command that inserts a timestamp.
		editor.addCommand( 'clickImageButton', {

			// Define the function that will be fired when the command is executed.
			exec: function( editor ) {
				$("#DescImage_TMP_INP").click();
				//editor.insertHtml( 'The current date and time is: <em>' + now.toString() + '</em>' );
			}
		});

		// Create the toolbar button that executes the above command.
		editor.ui.addButton( 'BurugoDescImage', {
			label: 'Picture',
			command: 'clickImageButton',
			toolbar: 'insert'
		});
	}
});