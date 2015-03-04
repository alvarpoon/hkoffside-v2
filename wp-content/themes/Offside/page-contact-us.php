<?php
/*
Template Name: Contact
*/

$response = "";

function my_contact_form_generate_response($type, $message){
    global $response;

    if($type == "success") $response = "<div class='success'>{$message}</div>";
    else $response = "<div class='error'>{$message}</div>";
}

//response messages
$not_human       = __('Human verification incorrect', 'margot');
$missing_content = __('Please supply all information', 'margot');
$email_invalid   = __('Email Address Invalid', 'margot');
$message_unsent  = __('Message was not sent', 'margot');
$message_sent    = __('Thanks! Your message has been sent', 'margot');

//user posted variables
$name = isset($_POST['message_name']) ? $_POST['message_name'] : null;
$email = isset($_POST['message_email']) ? $_POST['message_email'] : null;
$message = isset($_POST['message_text']) ? $_POST['message_text'] : null;
$human = isset($_POST['message_human']) ? $_POST['message_human'] : null;

//php mailer variables
$to = get_option('admin_email'); //admin email (Settings -> General)
$subject = "Someone sent a message from ".get_bloginfo('name');
$headers = 'From: '. $email . "\r\n" . 'Reply-To: ' . $email . "\r\n";

if(!$human == 0){
    if($human != 2) my_contact_form_generate_response("error", $not_human); //not human!
    else {
      //validate email
      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
        my_contact_form_generate_response("error", $email_invalid);
      else //email is valid
      {
        //validate presence of name and message
        if(empty($name) || empty($message)){
          my_contact_form_generate_response("error", $missing_content);
        }
        else //ready to go!
        {
          $sent = wp_mail($to, $subject, strip_tags($message), $headers);
          if($sent) my_contact_form_generate_response("success", $message_sent); //message sent!
          else my_contact_form_generate_response("error", $message_unsent); //message wasn't sent
        }
      }
    }
  }


  else if (isset($_POST['submitted']))my_contact_form_generate_response("error", $missing_content);

get_header();
?>

<div class="container container-page-content">
    <div id="mrg-wrap" class="omega">
        <div class="row">
        <?php if (have_posts()) : while (have_posts()) : the_post(); margot_setPostViews(get_the_ID()); ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <header class="mrg-page-header">
                    <div class="untop">
                        <div id="mrg-featured-media">
                        <?php margot_post_head(); ?>
                        </div>
                    </div>

                    <div class="mrg-head-title">
                        <h2><a href="<?php the_permalink(); ?>" title="<?php printf(esc_attr__('Permalink to %s', 'margot') , the_title_attribute('echo=0')); ?>" rel="bookmark"><?php single_post_title(); ?> </a></h2>
                    </div>
                </header>

                <div id="mrg-content" class="col-feed page-content page-full-width col-md-8">

                    <div class="entry-content">
                        <?php the_content(); ?>
                        <?php $args = array('before'=> '<p class="dphpost-pages"><span class="pgopen">' . __('Pages:', 'margot') .'','after'=> '</p>','link_before'=> '','link_after'=> '','next_or_number'=> 'number','pagelink'=> '<span>%</span>','echo'=> 1); wp_link_pages( $args ); ?>
                        <?php edit_post_link( __( 'Edit', 'margot' ), '<span class="edit-link">', '</span>' ); ?>
                    </div>

                    <div class="contact-form">
                    <?php echo $response; ?>
                    <form action="<?php the_permalink(); ?>" method="post">
                        <p class="contact_name inputcom"><label for="name"><?php _e('Name', 'margot'); ?>: <span class="required">*</span></label>
                        <input type="text" name="message_name" value="<?php echo esc_attr($name); ?>"></p>
                        <p class="contact_email inputcom"><label for="message_email"><?php _e('Email', 'margot'); ?>: <span class="required">*</span></label>
                        <input type="text" name="message_email" value="<?php echo esc_attr($email); ?>"></p>
                        <p class="textarea-p"><label for="message_text"><?php _e('Message', 'margot'); ?>:</label>    <span class="required">*</span> <textarea type="text" name="message_text"><?php echo esc_attr($message); ?></textarea></p>
                        <p><label class="human-label" for="message_human"><?php _e('Human Verification', 'margot'); ?>:</label> <span class="required">*</span> <br /> <input class="human-verify" type="text" style="width: 60px;" name="message_human"> <span class="verify">+ 3 = 5</span>
                        </p>
                        <input type="hidden" name="submitted" value="1">
                        <p class="form-submit"><input id="submit" class="rad-button" value="<?php _e('Submit', 'margot'); ?>" type="submit"></p>
                    </form>
                    </div> <!-- /contact-form -->

                    <div class="wave"></div> <div class="unroll"><hr class="mrg-sep" /></div>

                </div>

            </article>

            <?php endwhile; endif; wp_reset_query();

            if (!get_post_meta($post->ID, 'margot_meta_sidebar', false)) { get_sidebar(); }
            ?>
        
        </div> <hr class="border-push col-md-push-8 visible-md visible-lg" />
    </div>
</div>

<?php get_footer(); ?>