<?php

class DshTheme extends TimberSite
{
    public function __construct()
    {
        add_theme_support('post-formats');
        add_theme_support('post-thumbnails');
        add_theme_support('menus');
        add_filter('timber_context', [$this, 'add_to_context']);
        add_filter('get_twig', [$this, 'add_to_twig']);
        add_action('init', [$this, 'register_post_types']);
        add_action('init', [$this, 'register_taxonomies']);

        parent::__construct();
    }

    protected function register_post_types()
    {
        //this is where you can register custom post types
    }

    protected function register_taxonomies()
    {
        //this is where you can register custom taxonomies
    }

    public function add_to_context($context)
    {
        $context['foo']     = 'bar';
        $context['stuff']   = 'I am a value set in your functions.php file';
        $context['notes']   = 'These values are available everytime you call Timber::get_context();';
        $context['menu']    = new TimberMenu();
        $context['site']    = $this;
        return $context;
    }

    function add_to_twig($twig)
    {
        /* this is where you can add your own functions to twig */
        $twig->addExtension( new Twig_Extension_StringLoader() );
        $twig->addFilter('myfoo', new Twig_SimpleFilter('myfoo', array($this, 'myfoo')));
        return $twig;
    }

}
