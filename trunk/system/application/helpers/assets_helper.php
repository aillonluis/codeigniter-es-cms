<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Code Igniter Asset Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		Nick Cernis | www.goburo.com
 * @author 		Matias Montes | http://calaveradigital.blogspot.com/
 */

// ------------------------------------------------------------------------

 /**
  * Image tag helper
  *
  * Genera un tag IMG con la base_url para agregar imagenes dentro de las views.
  *
  * @access	public
  * @param	string	El nombre de la imagen (con extension)
  * @param	mixed 	Atributos varios
  * @return	string
  */

 function img_tag($image_name, $attributes = '')
 {
 	   if (is_array($attributes))
 	   {
 		   if (!isset($attributes['alt'])) $attributes['alt'] = '';
 		   $attributes = parse_tag_attributes($attributes);
 	   } elseif (is_string($attributes)) {
 	   		$attributes = ' alt="' . $attributes . '"';
 	   }

 	   $obj =& get_instance();
	   $base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
	   $img_folder = $obj->config->item('image_path');

 	   return '<img src="'.$base.$img_folder.$image_name.'"'.$attributes.' />';
 }

 /**
  * Image url helper
  *
  * Genera una url completa a una imagen
  *
  * @access	public
  * @param	string	El nombre de la imagen (con extension)
  * @return	string
  */

 function img_url($image_name = '') {
		$obj =& get_instance();
		$img_folder = $obj->config->item('image_path');
		$base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
		return $base.$img_folder.$image_name;
	}

 /**
  * Image path helper
  *
  * Genera una ruta completa del sistema de archivos hasta la imagen
  *
  * @access	public
  * @param	string	El nombre de la imagen (con extension)
  * @return	string
  */

	function img_path($image_name = '') {
		$obj =& get_instance();
		$img_folder = $obj->config->item('image_path');
		$base = dirname(rtrim(BASEPATH,'/')).'/';
		return $base.$img_folder.$image_name;
	}

 // ------------------------------------------------------------------------

  /**
   * Stylesheets include helper
   *
   * Genera un tag LINK usando la base_url que apunta a una hoja de estilos externa   *
   * @access	public
   * @param	  string	El nombre de la hoja de estilos - sin '.css'
   * @param	  mixed 	Atributos varios
   * @return	string
   */

  function add_style($stylesheet, $attributes = '')
  {
  	   if (is_array($attributes))
  	   {
  		   $attributes = parse_tag_attributes($attributes);
  	   }
  	   $obj =& get_instance();
 	   $base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
 	   $style_folder = $obj->config->item('stylesheet_path');

  	   return '<link rel="stylesheet" type="text/css" href="'.$base.$style_folder.$stylesheet.'.css"'.$attributes.' />'."\r\n";
  }

  /**   * Stylesheets url helper   *   * Genera una url a una hoja de estilos externa   *
   * @access	public
   * @param	  string	El nombre de la hoja de estilos - sin '.css'
   * @return	string
   */

  function style_url($stylesheet = '') {
		$obj =& get_instance();
		$base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
		$style_folder = $obj->config->item('stylesheet_path');
		$stylesheet = preg_match('/\.css$|^$/') ? $stylesheet : $stylesheet.'.css';
		return $base . $style_folder . $stylesheet;
	}

  /**   * Stylesheets path helper   *   * Genera una ruta completa hasta una hoja de estilos externa   *
   * @access	public
   * @param	  string	El nombre de la hoja de estilos - sin '.css'
   * @return	string
   */

	function style_path($stylesheet = '') {
		$obj =& get_instance();
		$base = dirname(rtrim(BASEPATH,'/')).'/';
		$style_folder = $obj->config->item('stylesheet_path');
		$stylesheet = preg_match('/\.css$|^$/',$stylesheet) ? $stylesheet : $stylesheet.'.css';
		return $base . $style_folder . $stylesheet;
	}

// ------------------------------------------------------------------------

 /**
  * Javascript include helper
  *
  * Genera un tag SCRIPT usando la base_url que apunta a un javascript externo
  *
  * @access	public
  * @param	string	El nombre del javascript - sin .'js'
  * @param	mixed 	Atributos varios
  * @return	string
  */

  function add_jscript($javascript, $attributes = '')
  {
	   if (is_array($attributes))
	   {
		   $attributes = parse_tag_attributes($attributes);
	   }
	   $obj =& get_instance();
 	   $base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
 	   $jscript_folder = $obj->config->item('javascript_path');

	   return '<script type="text/javascript" src="'.$base.$jscript_folder.$javascript.'.js"'.$attributes.'></script>'."\r\n";
  }

 /**
  * Javascript url helper
  *
  * Genera una url a un javascript externo
  *
  * @access	public
  * @param	string	El nombre del javascript - sin .'js'
  * @return	string
  */

  function jscript_url($javascript = '') {
		$obj =& get_instance();
		$base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
		$jscript_folder = $obj->config->item('javascript_path');
		return $base . $jscript_folder . $javascript . '.js';
	}

 /**
  * Javascript path helper
  *
  * Genera una ruta completa a un javascript externo
  *
  * @access	public
  * @param	string	El nombre del javascript - sin .'js'
  * @return	string
  */

	function jscript_path($javascript = '') {
		$obj =& get_instance();
		$base = dirname(rtrim(BASEPATH,'/')).'/';
		$jscript_folder = $obj->config->item('javascript_path');
		$javascript = preg_match('/\.js$|^$/',$javascript) ? $javascript : $javascript.'.js';
		return $base . $jscript_folder . $javascript ;
	}

 // ------------------------------------------------------------------------

 /**
  * Parsea los atributos
  *
  * Es usado por algunas de las funciones
  * (duplicado de la funcion parse_url_attributes de Rick Ellis en el URL Helper.)
  *
  * @access	private
  * @param	array
  * @return	string
  */
 function parse_tag_attributes($attributes)
 {
 	$att = '';
 	foreach ($attributes as $key => $val)
 	{
		$att .= ' ' . $key . '="' . $val . '"';
 	}

 	return $att;
 }

 // ------------------------------------------------------------------------

	/**
	 * Favicon include helper
	 *
	 * Genera un tag LINK usando la base_url que apunta al favicon
	 *
	 * @access    public
	 * @return    string
	 */

	function add_favicon()
	{
	 	$obj =& get_instance();
    $base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
    $img_folder = $obj->config->item('image_path');

    return '<link rel="shortcut icon" href="'.$base.$img_folder.'favicon.ico" />'."\r\n";
	}

	// ------------------------------------------------------------------------

	/**
	 *  Flash include helper
	 *
	 * Genera un tag object usando la base_url que apunta a un flash externo
	 * $params debe ser un array asociativo que sera usado para generar los tags 
	 * PARAM necesitados
	 *
	 * @access    public
	 * @param     string
	 * @param     array
	 * @param     mixed
	 * @param			string
	 * @return    string
	 */
	function add_flash($flash, $params = array(), $attributes = '', $innerHTML = '')
	{

		if (is_array($attributes))
		{
			$attributes = parse_tag_attributes($attributes);
		}

		$obj =& get_instance();
		$base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
		$media_folder = $obj->config->item("media_path");

		$tag  = "<object ";
		$tag .= "type=\"application/x-shockwave-flash\" ";
		$tag .= "data=\"{$base}{$media_folder}{$flash}.swf\" ";
		$tag .= $attributes;
		$tag .= ">";
		$tag .= "<param name=\"movie\" value=\"{$base}{$media_folder}{$flash}.swf\" />";

		foreach ($params as $k=>$v)
		{
			$tag .= "<param name=\"{$k}\" value=\"{$v}\" />";
		}

		$tag .= $innerHTML;

		$tag .= "</object>";

		return $tag;

	}

	// ------------------------------------------------------------------------

	/**
	 * Media url helper
	 *
	 * Genera una url que apunta a un archivo de medios externo
	 *
	 * @acces public
	 * @param string El nombre del archivo de medios con extension
	 * return string
	 */

	function media_url($media = '') {
		$obj =& get_instance();
		$base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
		$media_folder = $obj->config->item('media_path');
		return $base . $media_folder . $media;
	}

	/**
	 * Media path helper
	 *
	 * Genera una ruta que apunta a un archivo de medios externo
	 *
	 * @acces public
	 * @param string El nombre del archivo de medios con extension
	 * return string
	 */

	function media_path($media = '') {
		$obj =& get_instance();
		$base = dirname(rtrim(BASEPATH,'/')).'/';
		$media_folder = $obj->config->item('media_path');
		return $base . $media_folder . $media ;
	}

	// ------------------------------------------------------------------------

	/**
	 * Frame include helper
	 *
	 * Genera un frame
	 *
	 * @access  public
	 * @param   string  El controlador y metodo a cargar
	 * @param   string  El nombre del frame
	 * @return  string
	 */

	function add_frame($target,$name)
	{
    $obj =& get_instance();
    $base = $base = _is_secure() ? $obj->config->item('base_url_secure') : $obj->config->item('base_url');
    $index_page = $obj->config->item('index_page');
    if (!empty($index_page)) $base .= $index_page."/";

    return '<frame src="'.$base.$target.'" name="'.$name.'"  scrolling="auto" noresize="noresize" />';
	}

	// ------------------------------------------------------------------------

	/**
	 * Conexion segura
	 *
	 * Determina si la conexion es segura (HTTPS)
	 *
	 * @access private
	 * @return boolean
	 */

	function _is_secure() {
		return isset($_SERVER["HTTPS"]) && strtolower($_SERVER["HTTPS"]) == "on";
	}

// ------------------------------------------------------------------------

$CI =& get_instance();
$CI->config->load("assets");

?>
