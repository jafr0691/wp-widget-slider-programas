<?php
/*
Plugin Name: Widget Programacion
Plugin URI: https://github.com/jafr0691
Description: Feed de Programacion en WordPress
Author: Jesus Farias
Version: 1.0
Author URI: https://github.com/jafr0691
*/

defined('ABSPATH') or die('No script please!');

global $wpdb;
define('DocProgramas', plugin_dir_path(__FILE__));
define('ARCProgramas', plugin_dir_url(__FILE__));
define('postTitleProgramaPrograma', 'WIDGET PROGRAMACION');

require_once  DocProgramas.'plugin-update-checker/plugin-update-checker.php';

$myUpdateChecker = Puc_v4_Factory :: buildUpdateChecker (
     'https://grupoevolucion.com.ar/repository/plugins/Widget_programacion/details.json' ,
    __FILE__,'Widget_Programacion' 
);


class Widget_Programacion extends WP_Widget
{

     public function __construct(){
      // initialize widget name, id or other attributes
      parent::__construct("Widget_Programacion", "Programacion", array(
         'description' => 'Programacion en Wordpress'
      ));
      add_action("widgets_init", function(){
        register_widget("Widget_Programacion");
      });

    }
    
 
    public function form( $instance ) {
        $defaults = array( 'titlep' => __( 'Programaciones', 'wptheme' ), 'avatar' => 'on', 'tipo' => '0', 'efecto' => 'scrollHorz', 'anchura' => '300', 'altura' => '350' );
        $instance = wp_parse_args( ( array ) $instance, $defaults );
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'titlep' ); ?>">Titulo:</label>
            <input class="widefat"  id="<?php echo $this->get_field_id( 'titlep' ); ?>" name="<?php echo $this->get_field_name( 'titlep' ); ?>" type="text" value="<?php echo esc_attr( $instance[ 'titlep' ] ); ?>" />
        </p>
        <p>
            <table border="0"> 
    <tbody>

        <tr>
      <td>Tipo: <?php echo esc_attr( $instance[ 'tipop' ]); ?></td> 
      <td style="padding-left:5px;">
          <select name="<?php echo $this->get_field_name( 'tipop' ); ?>" style="font-size:14px;" id="<?php echo $this->get_field_id( 'tipop' ); ?>">
            
              <option  value="0" <?php if(esc_attr( $instance[ 'tipop' ]) == '0'){ echo 'selected="selected"'; } ?>>Border</option>
              <option  value="1" <?php if(esc_attr( $instance[ 'tipop' ]) == '1'){ echo 'selected="selected"'; } ?>>Simple</option>
    
          </select>
     </td>  
    </tr>
    <tr>
      <td>Efecto:</td> 
      <td style="padding-left:5px;">
      <select name="<?php echo $this->get_field_name( 'efectop' ); ?>" style="font-size:14px;" id="<?php echo $this->get_field_id( 'efectop' ); ?>">
        <option value="fade" <?php if(esc_attr( $instance[ 'efectop' ]) == 'fade'){ echo 'selected="selected"'; } ?>>Descol&#243;rese</option>
        
        <option value="scrollHorz" <?php if(esc_attr( $instance[ 'efectop' ]) == 'scrollHorz'){ echo 'selected="selected"'; } ?>>Horizontal</option>
        
        <option value="tileSlide" <?php if(esc_attr( $instance[ 'efectop' ]) == 'tileSlide'){ echo 'selected="selected"'; } ?>>Strips</option>
        
        <option value="tileBlind" <?php if(esc_attr( $instance[ 'efectop' ]) == 'tileBlind'){ echo 'selected="selected"'; } ?>>Blinds</option>
        
        <option value="shuffle" <?php if(esc_attr( $instance[ 'efectop' ]) == 'shuffle'){ echo 'selected="selected"'; } ?>>Barpaja</option>
      </select>
      </td>  
    </tr>
    <tr>
      <td>Color:</td> 
      <td><input type="color" class="color" name="<?php echo $this->get_field_name( 'colorp' ); ?>" value="<?php echo esc_attr( $instance[ 'colorp' ] ); ?>" style="background-color: rgb(242, 242, 242); color: rgb(0, 0, 0);" id="<?php echo $this->get_field_id( 'colorp' ); ?>"></td>  
    </tr>
    <tr>
      <td>Anchura:</td> 
      <td style="padding-left:5px;"><input name="<?php echo $this->get_field_name( 'anchurap' ); ?>" type="number" value="<?php echo esc_attr( $instance[ 'anchurap' ] ); ?>" onchange="calcWidth();" id="<?php echo $this->get_field_id( 'anchurap' ); ?>"></td>  
    </tr>
    <tr>
      <td>Altura:</td> 
      <td style="padding-left:5px;"><input name="<?php echo $this->get_field_name( 'alturap' ); ?>" type="number" value="<?php echo esc_attr( $instance[ 'alturap' ] ); ?>" id="<?php echo $this->get_field_id( 'alturap' ); ?>"></td>  
    </tr>
  </tbody></table>
        </p>

        <h3>
            Estilo de las letras
        </h3>
        <p>
            <table border="0"> 
    <tbody>

        <tr>
      <td>Programa:</td>
      </tr> 
      <tr>
      <td>
          
        <label for="color">Color:</label>
        </td>
        <td>
      <input type="color" class="color" name="<?php echo $this->get_field_name( 'colorn' ); ?>" value="<?php echo esc_attr( $instance[ 'colorn' ] ); ?>" style="background-color: rgb(242, 242, 242); color: rgb(0, 0, 0);" id="<?php echo $this->get_field_id( 'colorn' ); ?>">
        </td>
          
      </tr>
      <tr>
          <td>
       <label for="color">Color Hover:</label>
       </td>
       <td>
      <input type="color" class="coloh" name="<?php echo $this->get_field_name( 'colorh' ); ?>" value="<?php echo esc_attr( $instance[ 'colorh' ] ); ?>" style="background-color: rgb(242, 242, 242); color: rgb(0, 0, 0);" id="<?php echo $this->get_field_id( 'colorh' ); ?>">
      </td>
     </tr>  
    <tr>
      <td>Conductores y horas:</td> 
    </tr>
    <tr>
        <td>
            <label for="colorch">Color:</label>
        </td>
        <td>
            <input type="color" class="color" name="<?php echo $this->get_field_name( 'colorch' ); ?>" value="<?php echo esc_attr( $instance[ 'colorch' ] ); ?>" style="background-color: rgb(242, 242, 242); color: rgb(0, 0, 0);" id="<?php echo $this->get_field_id( 'colorch' ); ?>">
        </td>  
    </tr>
    <tr>
      <td>Color Hover conductores:</td> 
      </tr>
      <tr>
      <td>
        <label for="color">Color Inicio</label>
        </td>
        <td>
        <input type="color" class="color" name="<?php echo $this->get_field_name( 'colorci' ); ?>" value="<?php echo esc_attr( $instance[ 'colorci' ] ); ?>" style="background-color: rgb(242, 242, 242); color: rgb(0, 0, 0);" id="<?php echo $this->get_field_id( 'colorci' ); ?>">
        </td>
        </tr>
        <tr>
            <td>
        <span for="color">Color Final</span></td>
        <td>
      <input type="color" class="color" name="<?php echo $this->get_field_name( 'colorcf' ); ?>" value="<?php echo esc_attr( $instance[ 'colorcf' ] ); ?>" style="background-color: rgb(242, 242, 242); color: rgb(0, 0, 0);" id="<?php echo $this->get_field_id( 'colorcf' ); ?>"></td>  
    </tr>
  </tbody></table>
        </p>
  
        <?php
    }


 
    public function update( $new_instance, $old_instance ) {
        parent::update($new_instance, $old_instance);
        $instance = $old_instance;
        $instance['titlep'] = $new_instance['titlep'];
        $instance['tipop'] = $new_instance['tipop'];
        $instance['efectop'] = $new_instance['efectop'];
        $instance['colorp'] = $new_instance['colorp'];
        $instance['anchurap'] = $new_instance['anchurap'];
        $instance['alturap'] = $new_instance['alturap'];
        $instance['colorn'] = $new_instance['colorn'];
        $instance['colorh'] = $new_instance['colorh'];
        $instance['colorch'] = $new_instance['colorch'];
        $instance['colorci'] = $new_instance['colorci'];
        $instance['colorcf'] = $new_instance['colorcf'];

        return $instance;
    }
 
    public function widget( $args, $instance )
    {
        extract( $args, EXTR_SKIP );
        echo $before_widget;
        global $wpdb;
        $titlep = empty( $instance['titlep'] ) ? ' ' : apply_filters( 'widget_title', $instance['titlep'] );
        $regionsp = empty( $instance['regionsp'] ) ? 7 : esc_attr($instance['regionsp']);
        $efectop = empty( $instance['efectop'] ) ? 'none' : esc_attr($instance['efectop']);
        $tipop = empty( $instance['tipop'] ) ? '0' : esc_attr($instance['tipop']);
        $colorp = empty( $instance['colorp'] ) ? '#fff' : esc_attr($instance['color']);
        $alturap = empty( $instance['alturap'] ) ? '360' : esc_attr($instance['alturap']);
        $alturaclassp = $tipop==0? $alturap - 16:$alturap;
        $anchurap = empty( $instance['anchurap'] ) ? '300' : esc_attr($instance['anchurap']);
        $anchuraclassp = $tipop==0? $anchurap -16:$anchurap;

        $colorn =  empty( $instance['colorn'] ) ? '#ff0f59' : esc_attr($instance['colorn']);
        $colorh = empty( $instance['colorh'] ) ? '#7f07e8' : esc_attr($instance['colorh']);
        $colorch = empty( $instance['colorch'] ) ? '#ffffff' : esc_attr($instance['colorch']);
        $colori = empty( $instance['colori'] ) ? '#ff0f59' : esc_attr($instance['colori']);
        $colorf = empty( $instance['colorf'] ) ? '#ff0f59' : esc_attr($instance['colorf']);
        
        if ( ! empty($titlep) ) {
            echo $before_title . $titlep . $after_title;
            echo '
            <style type="text/css">

                .proradio-post__card__cap {
                    position: absolute;
                    bottom: 16px;
                    left: 8%;
                    padding: 0 10px 0 0;
                      padding-bottom: 0px;
                    z-index: 10;
                }

                .proradio-cats span{
                    border: 4px solid;
                    margin-right: 10px;
                    padding: 0 5px;
                    font-size: 2rem;
                    box-sizing: content-box;
                    margin: 10px 0 5px 0;
                    line-height: 1.2em;
                    font-size: 1.7rem;
                    border-color: '.$colorn.';
                    color: '.$colorn.';
                }
                .proradio-post__title a:hover {
                    background-size: 100% 0.16em;
                    -webkit-background-size: 100% 0.16em;
                    -moz-background-size: 100% 0.16em;
                    color: '.$colorch.';
                }

                .proradio-cats span:hover {
                    border-color: '.$colorh.';
                    color: '.$colorh.';
                    cursor: pointer;
                }
                .proradio-h4{
                    font-size: 1.5rem;
                }

                .proradio-cutme-t-2{
                    text-overflow: ellipsis;
                    overflow: hidden;
                    display: -webkit-box;
                    -webkit-line-clamp: 1;
                    -webkit-box-orient: vertical;
                    -webkit-box-orient: vertical;
                }

                .proradio-post__title a {
                    text-decoration: none;
                    background-size: 0% 0.25em;
                    background-repeat: no-repeat;
                    background-position: 0% 100%;
                    padding-right: 0;
                    transition: all 1.4s cubic-bezier(0.2, 0.9, 0, 1) !important;
                    background-image: linear-gradient(to right, '.$colori.' 50%, '.$colorf.' 100%, #fff 1%);
                    color: #fff;
                    font-size: 1.5rem;
                }
                .proradio-post__card .proradio-post__title {
                    margin: 10px 0 5px 0;
                    line-height: 1.2em;
                }
                .proradio-itemmetas{
                    padding-right: 5px;
                    font-family: Poppins;
                    font-weight: 600;
                    letter-spacing: 0em;
                    text-transform: uppercase;
                    margin: 0;
                      margin-bottom: 0px;
                    padding: 0;
                      padding-right: 0px;
                    font-size: 1.3rem;
                    color: '.$colorch.' !important;
                }

                .cart-slider:hover > .proimg{
                    opacity: 0.6 !important;
                }
            </style>
            <script>
                $(document).ready(function() {
                    var type = '.$tipop.';
                    var effect = "'.$efectop.'";
                    $(".slideshowPrograma").cycle({
                        fx: effect,
                        log: false,
                        timeout: 3800,
                        delay: -1000,
                        swipe: false,
                        slides: "#myslidep"
                    });


                    $(".slideshowPrograma").css({
                        overflow: "hidden"
                    });

                        var pausep = false;
                    $("#prevButtonp").click(function() {
                        $(".slideshowPrograma").cycle("prev");
                    });
                    $("#nextButtonp").click(function() {
                        $(".slideshowPrograma").cycle("next");
                    });
                    if (type === 0) {
                        $(".widget").css("border-radius", "4px");
                        $("#prevButtonp").css("background", "url(wp-content/plugins/Widget_programas/css/img/prev.png) no-repeat left 50%");
                        $("#prevButtonp").css("height","50px");
                        $("#prevButtonp").css("bottom","12px");
                        $("#prevButtonp").css("left","0px");
                        
                        $("#nextButtonp").css("background", "url(wp-content/plugins/Widget_programas/css/img/next.png) no-repeat right 50%");
                        $("#nextButtonp").css("height","50px");
                        $("#nextButtonp").css("bottom","12px");
                        $("#nextButtonp").css("right","0px");
                        $("#pauseButtonp").css("display","none");
                    
                    }else{
                        $(".barp").css("background-color","'.$color.'");
                        $("#prevButtonp").css("background", "url(wp-content/plugins/Widget_programas/css/img/larrow.png) no-repeat left 50%");
                        $("#prevButtonp").css("height","22px");
                        $("#prevButtonp").css("bottom","0px");
                        $("#prevButtonp").css("left","10px");
                        
                        $("#nextButtonp").css("background", "url(wp-content/plugins/Widget_programas/css/img/rarrow.png) no-repeat right 50%");
                        $("#nextButtonp").css("height","22px");
                        $("#nextButtonp").css("bottom","0px");
                        $("#nextButtonp").css("right","10px");
                    }
                    
                    
                    $("#pauseButtonp").click(function() {
                        pausep = !pausep;
                        if (!pausep) {
                            $("#pauseButtonp").css("background-image", "url(wp-content/plugins/Widget_programas/css/img/pause.png)");
                            $(".slideshowPrograma").cycle("resume");
                        }
                        else {
                            $("#pauseButtonp").css("background-image", "url(wp-content/plugins/Widget_programas/css/img/Play.png)");
                            $(".slideshowPrograma").cycle("pause");
                        }
                    });
                    if (type === 0) {
                        $("#nextButtonp").hide();
                        $("#prevButtonp").hide();
                    }

                    $(".widgep").bind("mouseenter",{self:this},function(e){
                        if (type === 0) {
                            $("#prevButtonp").fadeIn("fast");
                            $("#nextButtonp").fadeIn("fast");
                        }
                        if (!pausep)
                            $(".slideshowPrograma").cycle("pause");
                    });
                    $(".widgetp").bind("mouseleave",{self:this},function(e){
                        if (type === 0) {
                            $("#prevButtonp").fadeOut("fast");
                            $("#nextButtonp").fadeOut("fast");
                        }
                        if (!pausep)
                            $(".slideshowPrograma").cycle("resume");
                    });
                });
                </script>
                    <div class="widgetp gradp" style="width:'.$anchurap.'px;height:'.$alturap.'px;border:4px solid '.$color.'; margin-bottom: 10px;margin-top: 10px;">
                    <div class="imgnavp" style="width:'.$anchurap.'px;">
                        <a class="previousp" id="prevButtonp"></a>
                        <a class="nextp" id="nextButtonp"></a>
                        <a class="pausep" id="pauseButtonp"></a>
                        <div class="barp"></div>
                    </div>
                    <div class="slideshowPrograma" style="width:100%;height:100%;">';
                            $widgetprograma = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "Wgt_programacion");
                            foreach ($widgetprograma as $programa){
                                 echo '<div id="myslidep" class="cart-slider" style="position: relative;">
                                        <img src="'.$programa->img.'" class="proimg" style="height:'.$alturap.'px;" alt="img">
                                
                                        <div class="proradio-post__card__cap">
                                            <p class="proradio-cats">
                                                <span>'.$programa->programa.'</span>           
                                            </p>
                                            <h3 class="proradio-post__title proradio-cutme-t-2 proradio-h4">
                                                <a href="widget-programaciones/?t='.$programa->enlace.'" target="_top">'.$programa->conductores.'</a>
                                            </h3>
                                            <p class="proradio-itemmetas">
                                                '.$programa->horai.' - '.$programa->horaf.'              
                                            </p>
                                    </div>
                                </div>';
                                }
                    echo '</div>
                </div>';
        echo $after_widget;
    }
  }
 
}

function widget_Programacion_page_js()
{
    wp_enqueue_style('programacionpagewg', plugins_url('/css/style.css', __FILE__));
    
    wp_enqueue_script('programacion_widget_jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js');

    wp_enqueue_script('cycle2_file', plugin_dir_url(__FILE__) . 'js/jquery.cycle2.min.js');
  
  
}

add_action('wp_enqueue_scripts', 'widget_Programacion_page_js');

function sqlprograma()
{
    require_once DocProgramas . 'action/function.php';
    require_once DocProgramas . 'action/sqlProgramacion.php';
}

function control_jquery_programa()
{ 
    wp_enqueue_media();

    // wp_enqueue_script('bootstrap.3.4.1.programa', plugins_url('js/bootstrap.3.4.1.min.js', __FILE__));
    wp_register_script('script_sql_programa', plugin_dir_url(__FILE__) . 'js/sqlProWid.js', array('jquery'), '1', true);
    wp_enqueue_script('script_sql_programa');
    wp_localize_script('script_sql_programa', 'sqlprograma', ['sqlajaxpage' => admin_url('admin-ajax.php')]);
}
add_action('admin_enqueue_scripts', 'control_jquery_programa');
add_action('wp_ajax_sqlprograma', 'sqlprograma');
add_action('wp_ajax_nopriv_sqlprograma', 'sqlprograma');

function Wgt_programacion_panel()
{
    add_menu_page('widget Programacion', 'widget Programacion', 'manage_options', DocProgramas . 'action/controlProgramcionPage.php');
}
add_action('admin_menu', 'Wgt_programacion_panel');

add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'Wgt_programacion_action_links');
add_filter('network_admin_plugin_action_links_' . plugin_basename(__FILE__), 'Wgt_programacion_action_links');

function Wgt_programacion_action_links($links) {
    $url = get_admin_url() . "admin.php?page=Widget_Programacion/action/controlProgramacionPage.php";
    $links[] = '<a href="' . $url . '">' . __('Ajustes', 'textdomain') . '</a>';
    $links[] = '<a style="color:black">' . __('Support') . ':</a>';
    $links[] = '<br><center style="width:275px;color:white;background-color:#02a0d2;border-radius:0px 30px">info@evolucionstreaming.com</center>';
    return $links;
}

function db_widget_programacion(){

    global $wpdb;
    $query = $wpdb->prepare(
            'SELECT ID FROM ' . $wpdb->posts . '
                WHERE post_title = %s
                AND post_type = \'page\'',
            postTitlePrograma
        );
        $wpdb->query( $query );
        if ( $wpdb->num_rows ) {
            $wpdb->update($wpdb->posts,
            array('post_status'=> 'publish'),
            array('post_title' => postTitlePrograma,'post_type'=>'page'));
        } else {
        $new_page_id = wp_insert_post( array(
                'post_title'     => postTitlePrograma ,
                'post_type'      => 'page',
                'post_name'      => 'Programacion',
                'post_status'    => 'publish',
                'post_author'    => 1,
                'menu_order'     => 8,
                'page_template'  => 'template_programas.php'
            ) );
        $post_id = wp_insert_post($new_page_id);
    }
    require_once DocProgramas . 'db_widget_Programacion.php';
}

register_activation_hook(__FILE__, 'db_widget_programacion');

add_filter( 'page_template', 'widget_page_template_programas' );
function widget_page_template_programas( $page_template ){

    if ( get_page_template_slug() == 'template_programas.php' ) {
        $page_template = dirname( __FILE__ ) . '/template_programas.php';
    }
    return $page_template;
}

add_filter( 'theme_page_templates', 'widget_programas_add_template_to_select', 10, 5 );
function widget_programas_add_template_to_select( $post_templates, $wp_theme, $post, $post_type ) {

    // Add custom template named template-custom.php to select dropdown
    $post_templates['template_programas.php'] = __('widget-programaciones');

    return $post_templates;
}

$wp_plugin_widget_object = new Widget_Programacion();

function widget_programas_deactivate() {
    global $wpdb;
    $wpdb->update($wpdb->posts,
        array('post_status'=> 'draft'),
        array('post_title' => postTitlePrograma,'post_type'=>'page'));
}

register_deactivation_hook( __FILE__, 'widget_programas_deactivate' );


function widget_programacion_page_uninstall(){
    require_once DocProgramas . 'uninstall.php';
}
register_uninstall_hook( __FILE__, 'widget_programacion_page_uninstall' );

?>