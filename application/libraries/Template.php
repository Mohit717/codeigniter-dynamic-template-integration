<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Template
{
    private $CI;
    private $scripts_packages = array();
    private $stylesheet_packages = array();

    function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->config->load('packages');
    }

    // --------------------------------------------------------------------

    /*
     * Head
     *
     * Commonly used in the header template file immediately after the starting <head> tag
     * Combines the outputs of metadata, stylesheets, javascripts, and analytics in one function
     *
     * @return string
     */
    function head()
    {
        $return = '';
        $return .= $this->stylesheets();

        return $return;
    }

    // --------------------------------------------------------------------

    /*
     * Footer
     *
     * Commonly used in the footer template file immediately before the closing </body> tag
     * Outputs the footer javascripts
     *
     * @return string
     */
    function footer()
    {
        $return = '';
        $return .= $this->javascripts(TRUE);

        return $return;
    }

    function load($tpl_view, $body_view = null, $data = null)
    {
        if (!is_null($body_view)) {
            if (file_exists(APPPATH . 'views/' . $tpl_view . '/' . $body_view)) {
                $body_view_path = $tpl_view . '/' . $body_view;
            } else if (file_exists(APPPATH . 'views/' . $tpl_view . '/' . $body_view . '.php')) {
                $body_view_path = $tpl_view . '/' . $body_view . '.php';
            } else if (file_exists(APPPATH . 'views/' . $body_view)) {
                $body_view_path = $body_view;
            } else if (file_exists(APPPATH . 'views/' . $body_view . '.php')) {
                $body_view_path = $body_view . '.php';
            } else {
                show_error('Unable to load the requested file<br/>Template:' . $tpl_view . '<br/>View:' . $body_view . '.php');
            }

            $body = $this->CI->load->view($body_view_path, $data, TRUE);

            if (is_null($data)) {
                $data = array('body' => $body);
            } else if (is_array($data)) {
                $data['body'] = $body;
            } else if (is_object($data)) {
                $data->body = $body;
            }
        }

        $data['_head']      = $this->head(); 
        $data['_footer']    = $this->footer();
        $this->CI->load->view('templates/' . $tpl_view, $data);
    }

    // --------------------------------------------------------------------

    /*
     * Add Package
     *
     * Used to add predefined sets of javascripts and stylesheets
     *
     * @param string or array
     * @return object
     */

    function add_package($packages){
        $pkg_const = $this->CI->config->item('packages');
        if ( ! is_array($packages))
        {
            $packages = (array) $packages;
        }

        foreach($packages as $package){
            if (isset($pkg_const[$package]))
            {
                $package = $pkg_const[$package];
                
                if (isset($package['script']))
                {
                    $this->scripts_packages = $package['script'];
                }

                if (isset($package['stylesheet']))
                {
                    $this->stylesheet_packages = $package['stylesheet'];
                }
            }
        }

        return $this;
    }

    function stylesheets(){
        $style_includes = "";
        foreach($this->stylesheet_packages as $style){
            // If HTTP not in javascript uri add prepend base_url
            $style = (strpos($style, 'http') === 0 ? $style : base_url($style));
            $style_includes .= '<link href="'.$style.'" rel="stylesheet" type="text/css">';
        }
        return $style_includes;
    }

    function javascripts(){
        $js_includes = "";
        foreach($this->scripts_packages as $script){
            // If HTTP not in javascript uri add prepend base_url
            $script = (strpos($script, 'http') === 0 ? $script : base_url($script));
            $js_includes .= '<script src="'.$script.'"></script>';
        }
        return $js_includes;
    }
}
