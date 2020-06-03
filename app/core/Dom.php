<?php

namespace App\Core;

/*
 * This class help us to generate HTML and XML tag
 * All functions return string
 * @Author Yarin
 * @Updated By: Ratana
 * */
class Dom
{
    private static $_nct = ['br', 'img', 'hr', 'input', 'meta', 'area', 'base', 'col', 'param', 'source', 'track']; /* None closing tag */
    private static $_isJs = null;

    public static function __callStatic($dom, $params = [])
    {
        $props = $params[0]  ?? [];
        array_shift($params);
        
        return self::e($dom, $props, ...$params);
    }

    /**
     * Generate the concatenated string for
     * DOM Attribute and generate the Data attributes
     * if dataset property is defined.
     *
     * @param array $props Array key of Dom attribute items
     * @return string
     */
    private static function _attrs($props = [])
    {
        $dataset = [];
        $aria = [];
        foreach ($props['dataset'] ?? [] as $key => $val) {
            $key                     = str_replace("_", "-", $key);
            $dataset['data-' . $key] = htmlentities($val);
        }

        foreach ($props['aria'] ?? [] as $key => $value) {
            $key                     = str_replace("_", "-", $key);
            $aria['aria-' . $key] = htmlentities($value);
        }

        $str   = '';
        $props = self::rm_attrs($props, ['dataset', 'aria']);

        foreach (array_merge($dataset, $aria ,$props) as $key => $val) {
            $str .= ' ' . $key . '="' . htmlentities($val) . '"';
        }
        return $str;
    }


    /**
     * Join parameter list into string as DOM attributes
     * separated by space.
     *
     * @param mixed ...$vals The parameter list
     * @return mixed
     */
    protected function attr_val(...$vals)
    {
        return array_reduce($vals, function ($in, $val) {
            return $in .= ' ' . $val;
        }, '');
    }

    /**
     * Removes the key from provided attributes
     * and returns the remain attributes
     *
     * @param array $props The properties to which its attribute will be remove
     * @param array $attrs The list of attributes to be removed
     * @return array
     */
    protected static function rm_attrs($props, $attrs)
    {
        foreach ($attrs as $attr) {
            unset($props[$attr]);
        }
        return $props;
    }

    /**
     * Generates DOM content and returns string
     *
     * @param array $es List of Dom elements
     * @return string
     */
    protected static function dom_content($es)
    {
        return count($es) === 0 ? '' : array_reduce($es, function ($init, $e){
            if ($e instanceof HtmlString) return $init .= $e;
            if (is_array($e)) return $init .= self::dom_content($e);
            return $init .=  self::$_isJs ? $e : htmlentities($e, ENT_QUOTES, 'UTF-8', false);
        }, '');
    }

    /**
     * Returns the string represents the HTML DOM with
     * attributes defined in $props. The DOM content could be
     * list of DOM Element or any value.
     *
     * @param string $dom DOM Element
     * @param array $props List of DOM attributes
     * @param mixed ...$content List of DOM content
     * @return string
     */

    public static function e(string $dom, array $props = [], ...$content)
    {
        $str = '<' . $dom . self::_attrs($props);
        if (in_array($dom, self::$_nct)) return new HtmlString($str . ' />');
        $content = self::dom_content($content);
        return new HtmlString($str . '>' . $content . '</' . $dom . '>');
    }

    /*
     * Generate the DOM conten
     * @param $content List of dom element
     * @return string
     */
    public static function fragment(...$content)
    {
        return new HtmlString(self::dom_content($content));
    }


     /*
     * Generate the Js content
     * @param $content of js code
     * @return string
     */
    public static function script($content)
    {
        self::$_isJs = true;
        $script = self::e('script', ['type'=> "text/javascript"], $content);
        self::$_isJs = false;
        return $script;
    }
}
