<?php
class xpress
{
    public static function ajax()
    {
        $object = new Ajax();
        return $object;
    }

    public static function css()
    {
        $object = new CSSQueue();
        return $object;
    }

    public static function js()
    {
        $object = new JSQueue();
        return $object;
    }

    public static function fileSystem()
    {
        $object = new FileSystem();
        return $object;
    }

    public static function imageSize()
    {
        $object = new ImageSize();
        return $object;
    }

    public static function metaBox()
    {
        $object = new MetaBox();
        return $object;
    }

    public static function postType()
    {
        $object = new PostType();
        return $object;
    }

    public static function taxonomy()
    {
        $object = new Taxonomy();
        return $object;
    }

    public static function widget()
    {
        $object = new Widget();
        return $object;
    }



    /**
     * Based on answer by Stephen Watkins (http://stackoverflow.com/users/151382/stephen-watkins)
     * in StackOverflow: PHP random string generator (http://stackoverflow.com/questions/4356289/php-random-string-generator)
     *
     * @param number $length    length of the generated string
     *
     * @return boolean
     */
    public static function randomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }



    public static function currentUrl()
    {
        $protocol   = is_ssl() ? 'https://' : 'http://';
        $currentUrl = $protocol . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

        return $currentUrl;
    }



    public static function siteName()
    {
        return get_bloginfo('name');
    }



    public static function siteDescription()
    {
        return get_bloginfo('description');
    }



    public static function postsPerPage()
    {
        return get_option('posts_per_page');
    }



    public static function getMenu($location, $class, $walker = '')
    {
        $defaults = [
            'theme_location'=> $location,
            'menu_class'    => $class,
            'container'     => false,
            'echo'          => false,
            'walker'        => $walker
        ];

        return wp_nav_menu($defaults);
    }



    /**
     * Based on answer by Amereservant (http://stackoverflow.com/users/739165/amereservant)
     * in StackOverflow: how detect if current page is the login page (http://stackoverflow.com/questions/5266945/wordpress-how-detect-if-current-page-is-the-login-page)
     *
     * @return boolean
     */
    public static function isLoginPage() {
        return in_array($GLOBALS['pagenow'], array('wp-login.php', 'wp-register.php'));
    }



    public static function createPage($array)
    {
        foreach ($array as $item) {
            $parentSlug = isset($item['parent']) && $item['parent'] ? $item['parent'] : null;

            if (isset($item['slug'])) {
                $slug = $item['slug'];

                if (!isset($item['title'])) {
                    $item['title'] = str_ireplace('-', ' ', $slug);
                    $item['title'] = ucwords($item['title']);
                }
            } else {
                $slug = str_ireplace(' ', '-', $item['title']);
                $slug = strtolower($slug);
            }

            $path = $parentSlug ? $parentSlug . '/' . $slug : $slug;
            $page = get_page_by_path($path);
            $page = !$page ? get_page_by_path($slug) : $page;

            if ($page) {
                $id = $page->ID;
            } else {
                $parentPageId = 0;

                if ($parentSlug) {
                    $parentPage = get_page_by_path($parentSlug);
                    if ($parentPage) $parentPageId = $parentPage->ID;
                }

                $args = [
                    'post_type'     => 'page',
                    'post_status'   => 'publish',
                    'post_title'    => $item['title'],
                    'post_name'     => $slug,
                    'post_content'  => '',
                    'post_parent'   => $parentPageId
                ];

                $id = wp_insert_post($args);
            }

            if (isset($item['template']) && $item['template']) {
                if (get_post_meta($id, '_wp_page_template', true) !== $item['template']) {
                    update_post_meta($id, '_wp_page_template', $item['template']);
                }
            }
        }
    }
}
