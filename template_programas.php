<?php global $wpdb; ?>
<?php get_header();
/*
Template Name: Vista Diario Grande V2
*/
 ?>
	<?php if ( ! have_posts() ) : ?>
	<div class="content" style="WIDTH: 100% !IMPORTANT;">
		<?php get_template_part( 'framework/parts/not-found' ); ?>
	</div>
	<?php endif; ?>

	<?php while ( have_posts() ) : the_post(); ?>

	<?php tie_setPostViews() ?>

	<?php
		$get_meta = get_post_custom($post->ID);

		tie_update_reviews_info();

		if( !empty( $get_meta["tie_post_head_cover"][0] ) ) $content_width = 1000;
		if( !empty( $get_meta["tie_sidebar_pos"][0] ) && $get_meta["tie_sidebar_pos"][0] == 'full' ) $content_width = 955;

		$do_not_duplicate = array();

	?>

	<?php if( !empty( $get_meta["tie_post_head_cover"][0] ) ) : ?>
	<div class="post-cover-head">
		<?php get_template_part( 'framework/parts/post-head' ); ?>
	</div>
	<?php endif; ?>

	<div class="content<?php if( !empty( $get_meta["tie_post_head_cover"][0] ) ) echo ' post-cover';?>" style="WIDTH: 100% !IMPORTANT;">

		<?php if(  empty( $get_meta["tie_post_head_cover"][0] ) ||
				( !empty( $get_meta["tie_post_head_cover"][0] ) && ( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] != 'thumb' ) ) ) : ?>

		<?php tie_breadcrumbs() ?>

		<?php endif; ?>


		<?php //Above Post Banner
		if(  empty( $get_meta["tie_hide_above"][0] ) ){
			if( !empty( $get_meta["tie_banner_above"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_above"][0]) ) .'</div>';
			else tie_banner('banner_above' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>

		<article <?php post_class('post-listing'); ?> id="the-post">
			<?php if( empty( $get_meta["tie_post_head_cover"][0] ) ) get_template_part( 'framework/parts/post-head' ); ?>

			<div class="post-inner">

			<?php if(  empty( $get_meta["tie_post_head_cover"][0] ) || ( empty( $get_meta["tie_post_head"][0] ) &&  !tie_get_option( 'post_featured' ) ) ||
					( !empty( $get_meta["tie_post_head_cover"][0] ) && ( !empty( $get_meta['tie_post_head'][0] ) && $get_meta['tie_post_head'][0] != 'thumb' ) ) ) : ?>
				<h1 class="name post-title entry-title" itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing"><span itemprop="name"><?php the_title(); ?></span></h1>
                <?php $varprogramas = $wpdb->get_var("SELECT COUNT(*) FROM " . $wpdb->prefix . "Wgt_programacion");
				if($varprogramas==0){
					echo '<h3>No hay programas configurados</h3>';
				}
				?>
				<?php get_template_part( 'framework/parts/meta-post' ); ?>

				<div id="contenido_noticia"><?php the_content(); ?></div>
           			<div style="text-align: center;">

						<?php
						$Author = "Evolucion Streaming - Sericios Informáticos";
						$FECHA      = date("Y/m/d-H:00");
						if(isset($_GET['t'])){
							$srcimg = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "Wgt_programacion where enlace='{$_GET['t']}'");
							echo "<img width='100%' alt='".$srcimg->programa."' title='".$srcimg->programa."' 
							src='".$srcimg->img."?".$FECHA." ".$Author."'>";
						}
						 ?><br><br>
				   	</div>
                   <div style="text-align: center;"><br><br>
                    <?php

date_default_timezone_set("America/Argentina");

function image_exists($img,$enlace,$programa) {
    //obtenemos la cabeceras
    $FECHA      = date("Y/m/d-H:00");
    $file_headers = @get_headers($img);
    //comparamos si exise o no
    if($file_headers[0] == 'HTTP/1.1 404 Not Found') {



        echo '<div class="footer-widget news-pic">
                <div class="footer-widget-container" style="BORDER: 0PX;PADDING: 0PX"><div class="ancho" style="MARGIN-BOTTOM: 10PX;margin-right: 10px"><img style="float:left; border: #111111 4px outset; margin-right:14px; width:224px; height:275px; margin-bottom: 10px;" class="slidermovil" alt="'.$programa.' no disponible" title="'.$programa.' no disponible" src="'.ARCTPDiarios.'images/dafault.jpg"></div></div></div>';
    }
    else {

        echo '<div class="footer-widget news-pic">
                <div class="footer-widget-container" style="BORDER: 0PX;PADDING: 0PX"><div class="post-thumbnail tie-appear ancho" style="MARGIN-BOTTOM: 10PX;"><a class="ttip"  href="'.$enlace.'" title="'.$programa.'"><img style="float:left; border: #111111 4px outset; margin-right:5px; width:224px; height:275px;" class="slidermovil" src="'.$url.'?'.$FECHA.'" alt="'.$programa.'" title="'.$programa.'"><span class="fa overlay-icon"></span></a></div></div></div>';
    }
}
$postTitlePrograma = 'WIDGET PROGRAMACION';
    $linkp = $wpdb->get_row("SELECT ID FROM " . $wpdb->posts . " where post_title='{$postTitlePrograma}' AND post_type='page'");
    $enlac = post_permalink($linkp->ID);
    $listslider = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "Wgt_programacion");
    foreach ($listslider as $sliderdb) {
    	if(strpos($enlac, '?') !== false){
    		$enlace = $enlac.'&t='.$sliderdb->enlace;
    	}else{
    		$enlace = $enlac.'?t='.$sliderdb->enlace;
    	}
         $img = $sliderdb->img;
         $programa = $sliderdb->programa;
         image_exists($img,$enlace,$programa);
    }
//Separo mis url para que sean más legibles


?> </div>

			<?php endif; ?>

				<div class="entry">
					<?php if( ( tie_get_option( 'share_post_top' ) &&  empty( $get_meta["tie_hide_share"][0] ) ) || ( !empty( $get_meta["tie_hide_share"][0] ) && $get_meta["tie_hide_share"][0] == 'no' ) ) get_template_part( 'framework/parts/share'  ); // Get Share Button template ?>

					<?php if( tie_get_option( 'related_position' ) == 'in' ) get_template_part( 'framework/parts/related-posts' ); ?>

					<?php the_content(); ?>
					<?php wp_link_pages( array( 'before' => '<div class="page-link">' . __ti( 'Pages:' ), 'after' => '</div>' ) ); ?>

					<?php edit_post_link( __ti( 'Edit' ), '<span class="edit-link">', '</span>' ); ?>
				</div><!-- .entry /-->
				<?php the_tags( '<span style="display:none">',' ', '</span>'); ?>
				<span style="display:none" class="updated"><?php the_time( 'Y-m-d' ); ?></span>
				<?php if ( get_the_author_meta( 'google' ) ){ ?>
				<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><a href="<?php the_author_meta( 'google' ); ?>?rel=author">+<?php echo get_the_author(); ?></a></strong></div>
				<?php }else{ ?>
				<div style="display:none" class="vcard author" itemprop="author" itemscope itemtype="http://schema.org/Person"><strong class="fn" itemprop="name"><?php the_author_posts_link(); ?></strong></div>
				<?php } ?>
				<?php if( ( tie_get_option( 'share_post' ) && empty( $get_meta["tie_hide_share"][0] ) ) || ( !empty( $get_meta["tie_hide_share"][0] ) && $get_meta["tie_hide_share"][0] == 'no' ) ) get_template_part( 'framework/parts/share' ); // Get Share Button template ?>

				<div class="clear"></div>
			</div><!-- .post-inner -->
		</article><!-- .post-listing -->
		<?php if( tie_get_option( 'post_tags' ) ) the_tags( '<p class="post-tag">'.__ti( 'Tags ' )  ,' ', '</p>'); ?>


		<?php //Below Post Banner
		if( empty( $get_meta["tie_hide_below"][0] ) ){
			if( !empty( $get_meta["tie_banner_below"][0] ) ) echo '<div class="e3lan e3lan-post">' .do_shortcode( htmlspecialchars_decode($get_meta["tie_banner_below"][0]) ) .'</div>';
			else tie_banner('banner_below' , '<div class="e3lan e3lan-post">' , '</div>' );
		}
		?>

		<?php if( ( tie_get_option( 'post_authorbio' ) && empty( $get_meta["tie_hide_author"][0] ) ) || ( isset( $get_meta["tie_hide_related"][0] ) && $get_meta["tie_hide_author"][0] == 'no' ) ): ?>
		<section id="author-box">
			<div class="block-head">
				<h3><?php _eti( 'About' ) ?> <?php the_author() ?> </h3><div class="stripe-line"></div>
			</div>
			<div class="post-listing">
				<?php tie_author_box() ?>
			</div>
		</section><!-- #author-box -->
		<?php endif; ?>


		<?php if( tie_get_option( 'post_nav' ) ): ?>
		<div class="post-navigation">
			<div class="post-previous"><?php previous_post_link( '%link', '<span>'. __ti( 'Previous' ).'</span> %title' ); ?></div>
			<div class="post-next"><?php next_post_link( '%link', '<span>'. __ti( 'Next' ).'</span> %title' ); ?></div>
		</div><!-- .post-navigation -->
		<?php endif; ?>





		<?php endwhile;?>

<BR>
	</div><!-- .content -->
<?php get_footer(); ?>