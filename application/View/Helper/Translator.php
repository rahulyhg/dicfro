<?php
/**
 * Dicfro
 *
 * @author     Michel Corne <mcorne@yahoo.com>
 * @copyright  2008-2015 Michel Corne
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'View/Helper/Base.php';

class View_Helper_Translator extends View_Helper_Base
{
    /**
     * The translated strings
     *
     * @var array
     */
    public $translation = [];

    /*
     * Loads the translation file
     */
    public function init()
    {
        $file = sprintf('%s/../../translations/%s.php', __DIR__, $this->view->language);

        if (file_exists($file)) {
            $this->translation = require $file;
        }
    }

    /**
     * Tanslates a string in the given interface language
     *
     * @param string $string
     * @param string $english
     * @param bool $translate
     * @return string
     */
    public function translate($string, $english = null, $translate = true)
    {
        if ($translate and isset($this->translation[$string])) {
            $string = $this->translation[$string];
        } else if (isset($english)) {
            // word to translate to in English, eg "New/plural" => "New"
            $string = $english;
        }

        return $string;
    }
}
