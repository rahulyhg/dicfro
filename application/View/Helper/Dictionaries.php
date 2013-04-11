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
 * @copyright  2008-2010 Michel Corne
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

require_once 'View/Helper/Base.php';

/**
 * Dictionaries View Helper
 *
 * @category   DicFro
 * @package    View
 * @subpackage Helper
 * @author     Michel Corne <mcorne@yahoo.com>
 * @copyright  2008-2010 Michel Corne
 * @license    http://opensource.org/licenses/gpl-3.0.html GNU GPL v3
 */

class View_Helper_Dictionaries extends View_Helper_Base
{
    /**
     * Returns the dictionary description
     *
     * @return mixed the dictionary description
     */
    public function getDescription()
    {
        return isset($this->view->dictionary['description']) ? $this->view->dictionary['description'] : '';
    }

    /**
     * Returns the recently added dictionaries
     *
     * @return array
     */
    public function getNewDictionaries()
    {
        $options = array();

        foreach($this->view->config['dictionaries'] as $id => $dictionary) {
            list($year, $month, $day) = explode('-', $dictionary['created']);
            $time = time() - 30 * 24 * 3600;

            if (mktime(0, 0, 0, $month, $day, $year) >= $time) {
                // dictionary was added less than 30 days ago
                if (isset($dictionary['url'])) {
                    $value = $dictionary['url'];
                } else {
                    $value =  $id;
                }

                $options[] = array(
                    'text'     => $dictionary['name'],
                    'title'    => $dictionary['description'],
                    'value'    => $value,
                );
            }
        }

        return $options;
    }

    /**
     * Returns the groups of dictionaries for use in a select box
     *
     * @return array the groups of dictionaries
     */
    public function getGroups()
    {
        $dictionaries = $this->view->config['dictionaries'];
        $optgroups = array();

        foreach($this->view->config['groups'] as $group) {
            $options = array();

            foreach($group['dictionaries'] as $id) {
                $dictionary = $dictionaries[$id];

                if (isset($dictionary['url'])) {
                    $value = $dictionary['url'];
                } else {
                    $value =  $id;
                }

                $options[] = array(
                    'selected' => $id == $this->view->dictionary['id'],
                    'text'     => $dictionary['name'],
                    'title'    => $dictionary['description'],
                    'type'     => $dictionary['type'],
                    'value'    => $value,
                );
            }

            $optgroups[] = array(
                'label'   => $group['name'],
                'options' => $options,
            );
        }

        return $optgroups;
    }

    /**
     * Returns the page title
     *
     * @return string the page title
     */
    public function getPageTitle()
    {
        return isset($this->view->dictionary['title']) ? $this->view->dictionary['title'] : $this->view->dictionary['name'];
    }
}