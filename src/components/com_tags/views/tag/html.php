<?php

/**
 * Default Tag View
 *
 * @category   Anahita
 *
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2015 rmd Studio Inc.
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 *
 * @link       http://www.GetAnahita.com
 */
class ComTagsViewTagHtml extends ComBaseViewHtml
{
    /**
     * Initializes the options for the object.
     *
     * Called from {@link __construct()} as a first step of object instantiation.
     *
     * @param 	object 	An optional AnConfig object with configuration options.
     */
    protected function _initialize(AnConfig $config)
    {
        $config->append(array(
            'template_paths' => array(
                dirname(__FILE__).'/html',
                ANPATH_THEMES.'/'.$this->getService('application')->getTemplate().'/html/com_tags/tag'
            ),
        ));

        parent::_initialize($config);
    }
}
