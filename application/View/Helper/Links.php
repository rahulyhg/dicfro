<?php

/**
 * Dicfro
 *
 * PHP 5
 *
 * @category   DicFro
 * @package    View
 * @subpackage Helper
 * @author     Michel Corne <mcorne@yahoo.com>
 * @copyright  2008-2013 Michel Corne
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'View/Helper/Base.php';

/**
 * Links View Helper
 *
 * @category   DicFro
 * @package    View
 * @subpackage Helper
 * @author     Michel Corne <mcorne@yahoo.com>
 * @copyright  2008-2013 Michel Corne
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class View_Helper_Link extends View_Helper_Base
{
    /**
     * Links parameters
     *
     * @var array
     */
    public $arguments;

    /**
     * Create a simple link
     *
     * @param  string $name
     * @param  array  $arguments
     * @return string
     */
    public function __call($name, $arguments)
    {
        static $link = null;

        if (! isset($link[$name])) {
            $link[$name] = $this->setLink($this->arguments[$name]);
        }

        return $link[$name];
    }

    /*
     * Sets the links parameters
     *
     * @see View_Helper_Base::init()
     */
    public function init()
    {
        $this->arguments = [
            'setAboutLink'                => ['about', $this->view->dictionary['url']],
            'setArchivesLink'             => 'archives',
            'setDictionariesAvailability' => 'dictionaries-availability',
            'setDictionariesLink'         => 'dictionaries',
            'setDictionariesSearchTest'   => 'dictionaries-search-test',
            'setDictionaryLink'           => [$this->view->action, '%s', $this->view->word],
            'setDictlistLink'             => 'dictlist',
            'setHomeLink'                 => ['home', $this->view->dictionary['url']],
            'setIntroductionLink'         => ['introduction', $this->view->dictionary['url']],
            'setNextPageLink'             => ['next', $this->view->dictionary['url'], $this->view->page, $this->view->volume, $this->view->word],
            'setOptionsLink'              => ['options', $this->view->dictionary['url']],
            'setPreviousPageLink'         => ['previous', $this->view->dictionary['url'], $this->view->page, $this->view->volume, $this->view->word],
            'setWordLink'                 => ['search', $this->view->dictionary['url'], '%s'],
        ];
    }

    /**
     * Sets the go to a page link
     *
     * @return string
     */
    public function setGoPageLink($isEntries = false)
    {
        static $link = null;

        if (! isset($link[$isEntries])) {
            if (empty($isEntries)) {
                if (empty($this->view->dictionary['volume'])) {
                    $link[$isEntries] = $this->setLink(['page', $this->view->dictionary['url'], '%s', $this->view->word]);
                } else {
                    $link[$isEntries] = $this->setLink(['page', $this->view->dictionary['url'], '%s', '%s', $this->view->word]);
                }

            } else {
                if (empty($this->view->dictionary['volume'])) {
                    $link[$isEntries] = $this->setLink(['page', $this->view->dictionary['url'], '%s', '%s', $this->view->word]);
                } else {
                    $link[$isEntries] = $this->setLink(['page', $this->view->dictionary['url'], '%s', '%s', '%s', $this->view->word]);
                }
            }
        }

        return $link[$isEntries];
    }

    /**
     * Sets a link
     *
     * @param $arguments
     * @return string
     */
    public function setLink($arguments = [])
    {
        $arguments = array_filter((array) $arguments);
        array_unshift($arguments, $this->view->baseUrl);

        return implode('/', $arguments);
    }
}