<?php
/**
 * SexyButton Helper for v1.1
 *
 * @copyright ohguma
 * @license   http://www.opensource.org/licenses/mit-license.php The MIT License
 *
 *
 * Sexy Buttons is a HTML/CSS-based framework for creating beautiful web site buttons.
 *   http://code.google.com/p/sexybuttons/
 *
 * Sexy Buttons Quick Start Guide and Demo
 *   http://sexybuttons.googlecode.com/svn/trunk/index.html
 */

class SexyButtonHelper extends AppHelper
{
    /**
     * List of helpers used by this helper
     *
     * @var array
     */
    var $helpers = array('Html');

    /**
     * Default Settings
     */
    var $settings = array(
        'skin'  => null, //'sexysimple',
        'icon'  => null,
    );

    /**
     * Constructor
     *
     * @param array $settings  Defaults settings
     */
    function __construct($settings = array())
    {
        parent::__construct();
        if (!empty($settings)) $this->settings = array_merge($this->settings, $settings);
    }

    /**
     * <a> tag.
     *
     * @param string  $title        Title of link
     * @param string  $href         Href string "/products/view/12"
     * @param array   $options      Array of HTML attributes
     * @param string  $confirm      Confirmation message. Calls up a JavaScript confirm() message.
     * @param boolean $escapeTitle  Escaping the title string to HTML entities
     */
    public function link($title, $url = null, $options = array(), $confirm = false, $escapeTitle = true)
    {
        $options = array_merge($this->settings, $options);
        if (!isset($options['escape'])) {
            $options['escape'] = $escapeTitle;
        }
        if (!empty($options['disabled'])) {
            $options['onclick'] = 'return false;';
        }
        $text = $this->__getTitle($title, $options);
        $attr = $this->__getAttributes($options);
        return $this->Html->link($text, $url, $attr, $confirm, false);
    }

    /**
     * <button> tag
     *
     * @param string $title    Title of button
     * @param array  $options  Array of HTML attributes
     */
    public function button($title, $options = array())
    {
        $options = array_merge($this->settings, $options);
        if (!isset($options['escape'])) {
            $options['escape'] = true;
        }
        if (!isset($options['type'])) {
            $options['type'] = 'button';
        }
        $text = $this->__getTitle($title, $options);
        $attr = $this->__getAttributes($options);
        return sprintf('<button %s>%s</button>', $this->_parseAttributes($attr, null, '', ' '), $text);
    }

    /**
     * Return text for <a>/<button>
     *
     * @param string $title    Title of link/button
     * @param array  $options
     */
    function __getTitle($title, $options)
    {
        if ($options['escape']) {
            $title = h($title);
        }
        if (isset($options['icon'])) {
            $title = sprintf('<span class="%s">%s</span>', $options['icon'], $title);
        }
        if ($options['skin'] != 'sexysimple') {
            $title = sprintf('<span><span>%s</span></span>', $title);
        }
        return $title;
    }

    /**
     * Return html attributes for <a>/<button>
     *
     * @param array  $options
     */
    function __getAttributes($options)
    {
        //class
        $class = 'sexybutton';
        if (isset($options['class'])) {
            $class = $options['class'] . ' ' . $class;
        }
        if (!empty($options['skin'])) {
            $class .= ' ' . $options['skin'];
        }
        if (!empty($options['disabled'])) {
            $class .= ' disabled';
        }
        $options['class'] = $class;
        unset($options['escape'], $options['icon'], $options['skin']);
        return $options;
    }

}