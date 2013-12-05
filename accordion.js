//accordion is a jQueryUI object
//functions that were explained in the accordion manual (http://jqueryui.com/accordion/)
// were extended into this code as needed

$(function() {
	var icons = {
		header: "ui-icon-circle-arrow-e",
		activeHeader: "ui-icon-circle-arrow-s"
	};
	$( "#accordion" ).accordion( {
		active: false,
		collapsible: true,
		icons: icons,
		heightStyle: "content",
	});
	$( "#toggle" ).button().click(function() {
    if ( $( "#accordion" ).accordion( "option", "icons" ) ) {
      $( "#accordion" ).accordion( "option", "icons", null );
    } else {
      $( "#accordion" ).accordion( "option", "icons", icons );
    }
	});
});
