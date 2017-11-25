<?php

/**
 * Plugin Name: Hide Answers
 * Plugin URI: http://wpdevlms.com/
 * Description: Hides correct answer(s) when user's response is incorrect in LearnDash quiz.
 * Version: 1.0.0
 * Author: WPDevLMS
 * Author URI: http://wpdevlms.com/
 *
 * This is a free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * This is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * Drop a mail on wpdevlms@gmail.com for more information. Thank you!
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

/**
 * Hides correct answer(s) when user's response is incorrect in LearnDash quiz.
 * @author http://wpdevlms.com/ <wpdevlms@gmail.com>
 * @return void
 */
function wpdevlms_hide_correct() {
	global $post;

	if ( is_singular( 'sfwd-quiz' ) || ( !empty( $post ) && has_shortcode( $post->post_content, 'LDAdvQuiz' ) ) ) {
		?>
		<script type="text/javascript">
			jQuery(document).ready(function(){
				jQuery('#primary').on("click", 'input[name="reShowQuestion"]', function(){
					jQuery(".wpProQuiz_list .wpProQuiz_listItem").each(function(key, value){
						if('single' == jQuery(this).attr('data-type')) {
							if('none' != jQuery(this).find('.wpProQuiz_incorrect').css('display')) {
								jQuery(this).find('.wpProQuiz_questionList .wpProQuiz_questionListItem').removeClass('wpProQuiz_answerCorrect');
							}
						} else if('multiple' == jQuery(this).attr('data-type')) {
							jQuery(this).find('.wpProQuiz_questionList li').each(function(li_key, li_elem){
								if(jQuery(this).hasClass('wpProQuiz_answerCorrect') && !(jQuery(this).find('.wpProQuiz_questionInput').is(':checked'))) {
									jQuery(this).removeClass('wpProQuiz_answerCorrect');
								}
							});
						}
					});
				});
			});
		</script>
		<?php
	}
}
add_action( 'wp_footer', 'wpdevlms_hide_correct' );
