( function( $ ) {
    /* Inside of this function, $() will work as an alias for jQuery()
     and other libraries also using $ will not be accessible under this shortcut */
    $( 'document' ).ready( function() {

        /* for the correct work templastic with plugins BWS */  
        if ( $( 'body' ).hasClass( 'single-gallery' ) || $( 'body' ).hasClass( 'page-template-gallery-template-php' ) || $( 'body' ).hasClass( 'page-template-portfolio-php' ) ) {
            $( '#templastic_sidebar' ).insertAfter( '.content-area' );
            $( '.home_page_title' ).prependTo( '.gallery_box_single' );
            $( '.home_page_title' ).prependTo( '.gallery_box' );
        }
        if ( $( 'body' ).hasClass( 'single-portfolio' ) || $( 'body' ).hasClass( 'tax-portfolio_technologies' ) ) {
            $( '#templastic_sidebar' ).insertAfter( '.content-area' );  
        }

        /*clear for float */
        $( '.alignleft' ).parent().css( 'clear', 'both' );
        $( '.alignright' ).parent().css( 'clear', 'both' );

        /*navigation menu*/    
        var width_window = document.body.clientWidth; 
        $( '.templastic-toggleMenu' ).click( function( e ) {
            e.preventDefault();
            $( '.menu' ).toggle( 'slow' ); 
        }); 
        /*  Dropdown menu animation*/
        $( '.menu ul > li > ul' ).hide();
        $( '.menu li' ).hover( 
            function() {
                $( this ).children( 'ul' ).slideDown( 'fast' );
            }, 
            function() {
                $( this ).children( 'ul' ).hide();
            }
        );   
        if ( width_window < 805 ) {
            $( '.templastic-toggleMenu' ).css( 'display', 'inline-block' );
            $( '#templastic_header .menu' ).css( 'display', 'none' );
        } else {
            $( '.templastic-toggleMenu' ).css( 'display', 'none' );
            $( '.menu li' ).hover( function() {
                $( this ).addClass( 'hover' );
            }, function() {
                $( this ).removeClass( 'hover' );
            });
        }

        /*initial slider*/
        $( '.flexslider' ).flexslider( { 
            animation: "slide",
            directionNav: false
        }); 

        /*refresh all forms*/
        $( 'input:checked' ).removeAttr( 'checked' );
        $( 'input:file' ).val( '' );

        /*work with form elements*/
        /*radiobuttons restyle*/
        $( 'input[type=radio]' ).wrap( '<div class="templastic-radio"></div>' );

        /*hover realization*/
        $( '.templastic-radio' ).mouseenter( function() {
           $( this ).addClass( 'templastic-hover' );
        });
        $( '.templastic-radio' ).mouseleave( function() {
            $( this ).removeClass( 'templastic-hover' );
        });

        /*active realization*/
        $( '.templastic-radio' ).click( function() {
            var current_name = $( this ).find( 'input' ).attr( 'name' );
            if ( $( this ).find( 'input' ).is( ':checked' ) ) {
            } else {
                $( this ).closest( 'form' ).find( 'input[type=radio]' ).each( function() {
                    if ( $( this ).attr( 'name' ) == current_name ) {
                        $( this ).removeAttr( 'checked' );
                        $( this ).parent().removeClass( 'templastic-active' );
                    }
                });
                $( this ).addClass( 'templastic-active' );
                $( this ).find( 'input' ).attr( 'checked', true );
            }
        });

        /*checkboxes restyle*/
        $( 'input[type=checkbox]' ).wrap( '<div class="templastic-check"></div>' );

        /*hover realization*/
        $( '.templastic-check' ).mouseenter( function() {
           $( this ).addClass( 'templastic-hover' );
        });
        $( '.templastic-check' ).mouseleave( function() {
           $( this ).removeClass( 'templastic-hover' );
        });  

        /*active Realization*/
        $( '.templastic-check' ).click( function() {
            if ( $( this ).find( 'input' ).is( ':checked' ) ) {
                $( this ).removeClass( 'templastic-active' );
                $( this ).find( 'input' ).attr( 'checked', false );
            } else {
                $( this ).addClass( 'templastic-active' );
                $( this ).find( 'input' ).attr( 'checked', true );
            }
        });

        /*reset button restyle*/
        $( 'input:reset' ).click( function() {
            /*reset checkboxes and radio*/
            $( this ).closest( 'form' ).find( 'input' ).each( function() {
                $( this ).removeAttr( 'checked' );
            });
            $( this ).closest( 'form' ).find( '.templastic-option' ).removeClass( 'templastic-option-selected' );
            $( this ).closest( 'form' ).find( '.templastic-radio' ).removeClass( 'templastic-active' );
            $( this ).closest( 'form' ).find( '.templastic-check' ).removeClass( 'templastic-active' );
            /*reset input:file*/
            $( this ).closest( 'form' ).find( '.templastic-custom-file-text' ).text( script_loc.choose_file );
            $( this ).closest( 'form' ).find( '.templastic-custom-file-status' ).text( script_loc.file_is_not_selected );
        });

        /*select section restyle*/
        var test = $( 'select' ).size();
        for ( var k = 0; k < test; k++ ) {
            $( 'select' ).eq( k ).css( 'display', 'none' );
            $( 'select' ).eq( k ).after( CreateSelect( k ) );
        }

        /*functional of new select*/
        $( '.templastic-select' ).click( function() {
            if ( $( this ).find( '.templastic-options' ).css( 'display' ) == 'none' ) {
                $( this ).css( 'z-index', '100' );
                $( this ).find( '.templastic-options' ).css( 'display', 'block' );
            } else {
                $( this ).css( 'z-index', '10' );
                $( this ).find( '.templastic-options' ).css( 'display', 'none' );
            }
        });
        $( '.templastic-select' ).find( '.templastic-option' ).click( function() {
            $( this ).closest( '.templastic-select' ).find( '.templastic-option' ).removeClass( 'templastic-option-selected' );
            $( this ).addClass( 'templastic-option-selected' );
            /*write text to active opt*/
            $( this ).parent().parent().find( '.templastic-active-opt' ).find( 'div:first' ).text( $( this ).text() );
            /*remove active option from init select*/
            $( this ).parent().parent().prev( 'select' ).find( 'option' ).removeAttr( 'selected' );
            /*add atrr selected to select*/
            $( this ).parent().parent().prev( 'select' ).find( 'option' ).eq( ( $( this ).attr( 'name' ) ) ).attr( 'selected', 'selected' );
        });

        /*input:file restyle*/
        $( createInputAttr() );

        /*functional of new input:file*/
        $( '.templastic-custom-file' ).click( function() {
            var file_input = document.getElementById( $( this ).find( '.templastic-custom-file-status' ).attr( 'name' ) )
            $( file_input ).click();
        });
        $( 'input:file' ).change( function() {
            var val=$( this ).attr( 'id' );
            $( '[name='+val+']' ).text( $( this ).val().split( '\\' ).pop() )
        });

        /*archive-dropdown widget functional*/
        $( 'select[name=archive-dropdown]' ).next( '.templastic-select' ).find( '.templastic-option' ).click( function() {
            if ( $( this ).attr( 'value' ) ) {
                location.href = $( this ).attr( 'value' );
            }
        });

        /*category-dropdown widget functional*/
        $( '#cat' ).next( '.templastic-select' ).find( '.templastic-option' ).click( function() {
            if ( $( this ).attr( 'value' ) > 0 ) {
               location.href = script_loc.templastic_home_url + '?cat=' + $( this ).attr( 'value' );
            }
        });

        /* Check of previous selected items */
        $( 'select' ).each( function() {
            var index = $( this ).find( 'option[selected]' ).index();
            if ( index >= 0 ) {
                /*add attr selected to select*/
                var selected_select = $( this ).find( 'option[selected]' ).parent().next().find( ".templastic-options .templastic-option[name='" + index + "']" );
                selected_select.addClass( 'templastic-option-selected' );
                /*write text to active opt*/
                selected_select.parent().prev( '.templastic-active-opt' ).find( 'div:first' ).text( selected_select.text() );
            }
        });

        /* Clear select elements */
        $( 'input:reset' ).click( function() {
            /* Clear original selects. */
            $( 'select' ).each( function() {
                /* set path */
                var clear_select = $( this ).find( 'option:first' );
                var clear_selected_select = $( this ).find( 'option[selected]' );
                /* clear active opt */
                $( clear_selected_select ).removeAttr( 'selected' );
                $( clear_select ).attr( 'selected', 'selected' );
            });
            /* Clear custom selects. */
            $( '.templastic-select' ).each( function() {
                /* set path */
                var clear_select = $( this ).find( ".templastic-option[name='0']" );
                var clear_selected_select = $( this ).find( '.templastic-options' ).find( '.templastic-option-selected' );
                /* clear active opt */
                clear_select.parent().prev( '.templastic-active-opt' ).find( 'div:first' ).text( clear_select.text() );
                clear_selected_select.removeClass( 'templastic-option-selected' );
            });
        });
      });
} )( jQuery );

/* define all custom functions */
/*function for input:file*/
function CreateFileInput( k ) {
    var custom_file = document.createElement( 'div' );
    ( function( $ ) {
        $( custom_file ).addClass( 'templastic-custom-file' );
        $( custom_file ).append( '<div class="templastic-custom-file-content"></div>' );
        $( custom_file ).find( '.templastic-custom-file-content' ).append( '<div class="templastic-custom-file-text"></div>' );
        $( custom_file ).find( '.templastic-custom-file-content' ).append( '<div class="templastic-custom-file-button"></div>' );
        $( custom_file ).append( '<div class="templastic-custom-file-status"></div>' );
        $( custom_file ).find( '.templastic-custom-file-status').attr( 'name', $( 'input:file' ).eq( k ).attr( 'id' ) )
        $( custom_file ).find( '.templastic-custom-file-text' ).text( script_loc.choose_file );
        $( custom_file ).find( '.templastic-custom-file-status' ).text( script_loc.file_is_not_selected );
        $( custom_file ).append( '<div class="clear"></div>' );
    } )( jQuery );
    return custom_file;
}

/*function for hide init input:file and add after a new input:file*/
function createInputAttr() {
    ( function( $ ) {
        var size = $( 'input:file' ).size();
        for ( var i = 0; i < size; i++ ) {
            $( 'input:file' ).eq( i ).attr( 'id', 'file-' + i ).css( 'display', 'none' ).after( CreateFileInput( i ) );
        };
    } )( jQuery );
}

/*function for custom select*/
function CreateSelect( k ) {
    /*create select division*/
    var create_select = document.createElement( 'div' );
    ( function( $ ) {
        $( create_select ).addClass( 'templastic-select' );
        /*create active-option division*/
        var active_opt = document.createElement( 'div' );
        $( active_opt ).addClass( 'templastic-active-opt' );
        $( active_opt ).append( '<div></div>' );
        $( active_opt ).append( '<div class="templastic-select-button"></div>' );
        $( active_opt ).find( 'div:first' ).text( $( 'select' ).eq( k ).find( 'option' ).first().text() );
        /*create options division*/
        var option_array = document.createElement( 'div' );
        $( option_array ).addClass( 'templastic-options' );
        /*create array of optgroups*/
        var count = $( 'select' ).eq( k ).find( 'optgroup' ).size();
        var optgroups = [];
        /*create options division*/
        if ( count ) {
            var z = 0;
            for ( var i = 0; i < count; i++ ) {
                optgroups[i] = document.createElement( 'div' );
                $( optgroups[i] ).addClass( 'templastic-optgroup' );
                $( optgroups[i] )
                .text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).attr( 'label' ) );
            };
            for ( var i = 0; i < count; i++ ) {
                $( option_array ).append( optgroups[i] );
                for ( var j = 0; j < $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().size(); j++ ) {
                    var opt = document.createElement( 'div' );
                    $( opt ).addClass( 'templastic-option' );
                    $( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).attr( 'value' ) );
                    $( opt ).text( $( 'select' ).eq( k ).find( 'optgroup' ).eq( i ).children().eq( j ).text() );
                    $( opt ).attr( 'name', z );
                    z++;
                    $( option_array ).append( opt );
                };
            };
        } else {
            for ( var i = 0; i < $( 'select' ).eq( k ).find( 'option' ).size(); i++ ) {
                var opt = document.createElement( 'div' );
                $( opt ).addClass( 'templastic-option' );
                $( opt ).attr( 'value', $( 'select' ).eq( k ).find( 'option' ).eq( i ).attr( 'value' ) );
                $( opt ).attr( 'name', i );
                $( opt ).text( $( 'select' ).eq( k ).find( 'option' ).eq( i ).text() );
                $( option_array ).append( opt );
            };
        };
        $( create_select ).append( active_opt );
        $( create_select ).append( option_array );
    } )( jQuery );
    return create_select;
}