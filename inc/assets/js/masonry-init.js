jQuery( document ).ready( function( $ ) {

    var $thumbnail = '';
    var $srcset = '';
    var $srcsetarr = '';
    var $largeimg = '';
    var $totalimages = '';
    var $currentindex = '';
    var $currentimage = '';

    $( '.gallery-item a' ).addClass( 'closed' );

    /* Show Large images and hide thumbnails */
    $( '.gallery-item' ).on( 'click', 'a.closed', function( e ) {
        e.preventDefault();

        $( '.gallery-item a' ).removeClass( 'closed' ).addClass( 'opened' );

        /* Current index */
        $currentindex = $(this).parents( 'figure' ).index();        

        setcurrentimage( $currentindex );

        $currentimage.parents( '.vigor-masonry' ).addClass( 'hide-columns' );

        /* Total number of images */
        $totalimages = $currentimage.parents( '.vigor-masonry' ).find( 'img' ).length;

        /* Show navigation */
        $currentimage.parents( '.vigor-masonry' ).prepend( '<div class="gallery-navigation"><div class="navigation"><a class="previous" href="#" title="previous">&larr;</a><a class="next" href="#" title="next">&rarr;</a></div><p class="count"><span class="current">' + ( $currentindex + 1 ) + '</span><span class="divider">/</span><span class="total">' + $totalimages + '</span><a class="back" href="#">Back to Thumbnails</a></p></div>' );


    });

    $( '.gallery-item' ).on( 'click', 'a.opened', function( e ) {
        e.preventDefault();   
    });

    /* Show thumbnails */
    $( '.vigor-masonry' ).on( 'click', '.back', function( e ) {
        e.preventDefault();
        // $(this).parents( '.gallery-size-masonry' ).find( '.gallery-item' ).show();
        $(this).parents( '.vigor-masonry' ).removeClass( 'hide-columns' );
        $( 'figure.current' ).removeClass( 'current' );
        $(this).parents( '.gallery-navigation' ).remove();
        
        $( '.gallery-item a' ).removeClass( 'opened' ).addClass( 'closed' );

        /* Reset img url */
        $( 'figure.current' ).find( 'img' ).attr( 'src', $thumbnail );
    } );

    /* Gallery navigation, show next image */
    $( '.vigor-masonry' ).on( 'click', '.gallery-navigation .next, .next-image', function( e ) {
        e.preventDefault();

        $currentimage.removeClass( 'current' );

        /* Reset img url */
        $currentimage.find( 'img' ).attr( 'src', $thumbnail );

        if( $totalimages > ( $currentindex + 1 ) ) {
            $currentindex = ( $currentindex + 1 );
        }

        setcurrentimage( $currentindex );


    } );

    /* Gallery navigation, show previous image */
    $( '.vigor-masonry' ).on( 'click', '.gallery-navigation .previous, .previous-image', function( e ) {
        e.preventDefault();

        $currentimage.removeClass( 'current' );
        
        /* Reset img url */
        $currentimage.find( 'img' ).attr( 'src', $thumbnail );

        if( $currentindex > 0 ) {
            $currentindex = ( $currentindex - 1 );
        } else {
            $currentindex = $currentindex;
        }

        setcurrentimage( $currentindex );

    } );

    /* Image Navigation */

    /* Set the correct image during navigation*/
    function setcurrentimage( $currentindex ) {

        $currentimage = $( 'figure' ).eq( $currentindex );

        $currentimage.addClass( 'current' );

        $thumbnail = $currentimage.find( 'img' ).attr( 'src' );

        $srcset = $currentimage.find( 'img' ).attr( 'srcset' );
        
        /* Grab the large image size */
        if( $srcset === undefined ) {
            $largeimg = $thumbnail;
        } else {            
            $srcsetarr = $.map($srcset.split( ',' ), $.trim);
            $largeimg = $.map($srcsetarr[1].split( ' ' ), $.trim);
            $largeimg = $largeimg[0];
        }        

        /* Assign the URL to the img tag */
        $currentimage.find( 'img' ).attr( 'src', $largeimg );
        
        /* Update Index */
        $( 'span.current' ).html( $currentindex + 1 );

        /*  Add Image Nav */
        $imagenav = '<div class="navigation-image"><a class="previous-image" href="#" title="previous"></a><a class="next-image" href="#" title="next"></a></div>';
        $( '.navigation-image' ).remove( );
        $currentimage.find( '.gallery-icon' ).append( $imagenav );

    }; 

} );