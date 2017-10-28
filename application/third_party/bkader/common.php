<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('dot')) {
	/**
	 * Access multidimensional array using dot-notation
     *
     * @author 	Kader Bouyakoub  <bkader@mail.com>
     * @link    @bkader          <github>
     * @link    @KaderBouyakoub  <twitter>
     *
	 * @param   string
	 * @return  mixed
	 */
    function dot(&$arr, $path = null, $default = null)
    {
        if ( ! $path) {
            user_error("Missing array path for array", E_USER_WARNING);
        }
        $parts = explode(".", $path);
        is_array($arr) or $arr = (array) $arr;
        $path =& $arr;
        foreach ($parts as $e) {
            if ( ! isset($path[$e]) or empty($path[$e])) {
                return $default;
            }
            $path =& $path[$e];
        }
        return $path;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('get_host'))
{
    /**
     * Returns server's name
     *
     * @author  Kader Bouyakoub  <contact@bkader.com>
     * @link    @bkader          <github>
     * @link    @KaderBouyakoub  <twitter>
     *
     * @access  public
     * @param   void
     * @return  string
     */
    function get_host()
    {
        if (isset($_SERVER['SERVER_NAME']))
        {
            return $_SERVER['SERVER_NAME'];
        }
        elseif (isset($_SERVER['HOSTNAME']))
        {
            return $_SERVER['HOSTNAME'];
        }
        elseif (isset($_SERVER['SERVER_ADDR']))
        {
            return strpos($_SERVER['SERVER_ADDR'], '::') === false
                    ? $_SERVER['SERVER_ADDR']
                    : '['.$_SERVER['SERVER_ADDR'].']';
        }
        else
        {
            return 'localhost';
        }
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('urlinfo'))
{
    /**
     * Returns an array of URL and URI data
     *
     * @author  Kader Bouyakoub  <contact@bkader.com>
     * @link    @bkader          <github>
     * @link    @KaderBouyakoub  <twitter>
     *
     * @access  public
     * @param   void
     * @return  array
     */
    function urlinfo() 
    {
        if ( ! function_exists('path_merge'))
        {
            $CI =& get_instance();
            $CI->load->helper('path');
        }
        $is_https        = is_https();
        $server_protocol = is_https() ? 'https' : 'http';
        $server_name     = get_host();

        if (isset($_SERVER['SERVER_PORT']) and !(strpos($server_name, '::') === false ? strpos($server_name, ':') === false : strpos($server_name, ']:') === false)
                and (($server_protocol == 'http'
                and $_SERVER['SERVER_PORT'] != 80 ) || ($server_protocol == 'https' and $_SERVER['SERVER_PORT'] != 443)))
        {
            $server_name_extra = $server_name.':'.$_SERVER['SERVER_PORT'];
            $port = (int) $_SERVER['SERVER_PORT'];

        }
        else
        {
            $server_name_extra = $server_name;
            $port = $is_https ? 443 : 80;
        }
        $server_url = $server_protocol.'://'.$server_name_extra;

        $script_name = $_SERVER['SCRIPT_NAME'];
        $script_path = str_replace(basename($script_name), '', $script_name);

        if (defined('FCPATH'))
        {
            $base_url = $server_url.rtrim(preg_replace('/'.preg_quote(str_replace(FCPATH, '', path_merge(FCPATH, $script_path).'/'), '/').'$/', '', $script_path), '/').'/';

        }
        else
        {
            $base_url = $server_url.'/';
        }

        $base_uri = parse_url($base_url, PHP_URL_PATH);

        if (substr($base_uri, 0, 1) != '/')
        {
            $base_uri = '/'.$base_uri;
        }

        if (substr($base_uri, -1, 1) != '/')
        {
            $base_uri .= '/';
        }
        $current_uri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '/';
        $current_url = $server_url.$current_uri;
        $server_url .= '/';

        $current_uri_string   = parse_url($current_url, PHP_URL_PATH);
        $current_query_string = parse_url($current_url, PHP_URL_QUERY);

        return compact(
            'base_url',
            'base_uri',
            'current_url',
            'current_uri',
            'current_uri_string',
            'current_query_string',
            'server_url',
            'server_name',
            'server_protocol',
            'is_https',
            'script_name',
            'script_path',
            'port'
        );
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('str_to_bool'))
{
    /**
     * Coverts a string boolean representation to a true boolean
     *
     * @author  Kader Bouyakoub  <contact@bkader.com>
     * @link    @bkader          <github>
     * @link    @KaderBouyakoub  <twitter>
     *
     * @access  public
     * @param   string
     * @param   boolean
     * @return  boolean
     */
    function str_to_bool($str, $strict = false)
    {
        // If no string is provided, we return 'false'
        if (empty($str))
        {
            return false;
        }

        // If the string is already a boolean, no need to convert it
        if (is_bool($str))
        {
            return $str;
        }

        $str = strtolower(@ (string) $str);
        
        if (in_array($str, array('no', 'n', 'false', 'off')))
        {
            return false;
        }

        if ($strict)
        {
            return in_array($str, array('yes', 'y', 'true', 'on', '1'));
        }
        return true;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('is_str_to_bool'))
{
    /**
     * Checks whether a given value can be a strict string
     * representation or a true boolean
     *
     * @author  Kader Bouyakoub  <contact@bkader.com>
     * @link    @bkader          <github>
     * @link    @KaderBouyakoub  <twitter>
     *
     * @access  public
     * @param   string
     * @param   boolean
     * @return  boolean
     */
    function is_str_to_bool($str, $strict = false)
    {
        if ( ! $strict)
        {
            $str_test = @ (string) $str;
            if (is_numeric($str_test))
            {
                return true;
            }
        }
        return ( ! str_to_bool($str) or str_to_bool($str, true) );
    }
}


// ------------------------------------------------------------------------

if ( ! function_exists('generate_uuid4')) {
    /**
     * Generates a random UUID (v4)
     * @since   4.7.0
     * @return  string  UUID
     */
    function generate_uuid4()
    {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('is_serialized')) {
    /**
     * Check value to find if it was serialized.
     * @param   string  $str    value to check if serialized
     * @return  boolean
     */
    function is_serialized($str)
    {
        // If $str is not a string, there is no chance
        // it may be serialized.
        if ( ! is_string($str)) {
            return false;
        }

        $str = @unserialize($str);
        return ($str !== false);
    }
}

if ( ! function_exists('__serialize')) {
    /**
     * Turns arrays and objects only into serialized string
     * @param   mixed   $str
     * @return  string
     */
    function __serialize($arg = null)
    {
        return (is_array($arg) || is_object($arg)) ? serialize($arg) : $arg;
    }
}

if ( ! function_exists('__unserialize')) {
    /**
     * Turns a serialized string into its nature
     * @param   string  $str    the string to return
     * @return  mixed
     */
    function __unserialize($str)
    {
        return is_serialized($str) ? unserialize($str) : $str;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('is_json')) {
    /**
     * Checks whether a string is a json_encoded
     * @param   string  $str
     * @return  boolean
     */
    function is_json($str)
    {
        json_decode($str);
        return (json_last_error() == JSON_ERROR_NONE);
    }
}

if ( ! function_exists('__json_encode')) {
    /**
     * Turns arrays and objects into json encoded strings
     * @param   mixed   $arg
     * @return  string
     */
    function __json_encode($arg = null)
    {
        return (is_array($arg) || is_object($arg)) ? json_encode($arg) : $arg;
    }
}

if ( ! function_exists('__json_decode')) {
    /**
     * Turns a json encoded string into its true nature
     * @param   string  $str
     * @return  array
     */
    function __json_decode($str)
    {
        return is_json($str) ? json_decode($str) : $str;
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('array_is_multi'))
{
    /**
     * This function return true if an array is multidimensional
     * @param   array   $arr    the array to check
     * @return  boolean
     */
    function array_is_multi($arr)
    {
        // Here is what we check:
        // 1. $arr is really an array.
        // 2. At least the first element is set ($arr[0]).
        // 3. The first element is an array.

        return (is_array($arr) && isset($arr[0]) && is_array($arr[0]));
    }
}

// ------------------------------------------------------------------------

if ( ! function_exists('build_path'))
{
    /**
     * This function smartly builds a path using DIRECTORY_SEPARATOR
     *
     * @param   mixed   strings or array
     * @return  string  the full path built
     * @author  Kader Bouyakoub <bkader@mail.com>
     * @link    http://www.bkader.com/
     */
    function build_path()
    {
        // We build the path only if arguments are passed
        if ( ! empty($args = func_get_args()))
        {
            // Make sure arguments are an array but not a mutidimensional one
            isset($args[0]) && is_array($args[0]) && $args = $args[0];

            return implode(DIRECTORY_SEPARATOR, array_map( 'rtrim', $args, array(DIRECTORY_SEPARATOR))).DIRECTORY_SEPARATOR;
        }

        return null;
    }
}

/* End of file KB_Common.php */
/* Location: ./application/core/KB_Common.php */
