<?php 
/*
Plugin Name: Advanced Custom Fields Character Limiter
Plugin URI: https://github.com/daltonrooney/advanced-custom-fields-character-limiter/
Description: Add "x characters left" display to any ACF text input or textarea field with a character limit.
Version: 0.2
Author: daltonrooney
Author URI: http://www.madebyraygun.com

------------------------------------------------------------------------

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA
*/

function acfcl_acf_admin_head() { ?> 

<script type="text/javascript">
(function($){
    function addCharLimit(){
         $('.acf-input textarea, .acf-input input[type="text"]').each(function(){
            maxlength = $(this).attr("maxlength");
            if ( maxlength !== undefined && maxlength > 0 ) {
                charContainer = $(this).parent().find('p.charleft').val();
                if ( charContainer === undefined ) {
                    $(this).parent().append("<p class='charleft description'>");
                }
                charleft = maxlength - $(this).val().length;
                $(this).parent().find('.charleft').html(charleft+" characters left.");
            }

            $(this).keyup(function() {
                if ( maxlength !== undefined  && maxlength > 0 ) {
                    charleft = maxlength - $(this).val().length;
                    $(this).parent().find('.charleft').html(charleft+" characters left.");
                }
            })
        });
    }

    acf.add_action('ready append', function( $el ){
        addCharLimit();
    });
})(this.jQuery);
</script>

<?php }
 
add_action('acf/input/admin_head', 'acfcl_acf_admin_head');
