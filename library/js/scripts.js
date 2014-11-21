/*
Bones Scripts File
Author: Eddie Machado

This file should contain any js scripts you want to add to the site.
Instead of calling it in the header or throwing it inside wp_head()
this file will be called automatically in the footer so as not to
slow the page load.

*/

// as the page loads, call these scripts
jQuery(document).ready(function($) {

    // ADD CLASS TO LINKS CONTAINING IMAGES
    $('a:has(img)').addClass('imglink');

    // ADD COUNT CLASS TO FOOTER WIDGETS FOR STYLING
     var num;
     num = $('.footer-widgets-main').children('.widget').size();
     $('.footer-widgets-main').addClass('floats_' + num);

     // ADD HOVER CLASS FOR MENUS
     $('.nav li').has('ul').hover(function() {
            $(this).addClass('hover');
        }, function() {
            $(this).removeClass('hover');
    });

    //
    

   width = $('body').innerWidth();
    if (width < 768) {  
        // add clearfix classs to top band if screen smaller than 768
        $('.taupe.swoop').addClass('clearfix');
        //$('.blue.swoop').addClass('clearfix');

        // Create the dropdown base
        $("<select />").appendTo(".blue.swoop");
        
        // Create default option "Go to..."
        $("<option />", {
           "selected": "selected",
           "value"   : "",
           "text"    : "Menu"
        }).appendTo(".blue.swoop select");
        
        // Populate dropdown with menu items
        $(".top-nav > li > a").each(function() {
         var el = $(this);
         $("<option />", {
             "value"   : el.attr("href"),
             "text"    : el.text()
         }).appendTo(".blue.swoop select");
        });

        // Populate dropdown with menu items
        $(".ancillary-nav > li > a").each(function() {
         var el = $(this);
         $("<option />", {
             "value"   : el.attr("href"),
             "text"    : el.text()
         }).appendTo(".blue.swoop select");
        });


        
        $(".blue.swoop select").change(function() {
          window.location = $(this).find("option:selected").val();
        });
    }
	
 
}); /* end of as page load scripts */


/*! A fix for the iOS orientationchange zoom bug.
 Script by @scottjehl, rebound by @wilto.
 MIT License.
*/
(function(w){
	// This fix addresses an iOS bug, so return early if the UA claims it's something else.
	if( !( /iPhone|iPad|iPod/.test( navigator.platform ) && navigator.userAgent.indexOf( "AppleWebKit" ) > -1 ) ){ return; }
    var doc = w.document;
    if( !doc.querySelector ){ return; }
    var meta = doc.querySelector( "meta[name=viewport]" ),
        initialContent = meta && meta.getAttribute( "content" ),
        disabledZoom = initialContent + ",maximum-scale=1",
        enabledZoom = initialContent + ",maximum-scale=10",
        enabled = true,
		x, y, z, aig;
    if( !meta ){ return; }
    function restoreZoom(){
        meta.setAttribute( "content", enabledZoom );
        enabled = true; }
    function disableZoom(){
        meta.setAttribute( "content", disabledZoom );
        enabled = false; }
    function checkTilt( e ){
		aig = e.accelerationIncludingGravity;
		x = Math.abs( aig.x );
		y = Math.abs( aig.y );
		z = Math.abs( aig.z );
		// If portrait orientation and in one of the danger zones
        if( !w.orientation && ( x > 7 || ( ( z > 6 && y < 8 || z < 8 && y > 6 ) && x > 5 ) ) ){
			if( enabled ){ disableZoom(); } }
		else if( !enabled ){ restoreZoom(); } }
	w.addEventListener( "orientationchange", restoreZoom, false );
	w.addEventListener( "devicemotion", checkTilt, false );
})( this );