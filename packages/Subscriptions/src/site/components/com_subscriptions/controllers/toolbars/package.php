<?php

/** 
 * 
 * @category   Anahita
 * @package    Com_Subscriptions
 * @subpackage Controller_Toolbar
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @copyright  2008 - 2015 rmdStudio Inc.
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @link       http://www.GetAnahita.com
 */

/**
 * Actorbar. 
 *
 * @category   Anahita
 * @package    Com_Subscriptions
 * @subpackage Controller_Toolbar
 * @author     Rastin Mehr <rastin@anahitapolis.com>
 * @license    GNU GPLv3 <http://www.gnu.org/licenses/gpl-3.0.html>
 * @link       http://www.GetAnahita.com
 */

class ComSubscriptionsControllerToolbarPackage extends ComBaseControllerToolbarDefault
{
    /**
     * Before Controller _actionRead is executed
     *
     * @param KEvent $event
     *
     * @return void
     */
    public function onBeforeControllerGet(KEvent $event)
    {
        parent::onBeforeControllerGet($event);

        if($this->getController()->getItem())
        {
           $this->addToolbarCommands(); 
        } 
    }
    
    /**
     * Called after controller browse
     *
     * @param KEvent $event
     *
     * @return void
     */
    public function onAfterControllerBrowse(KEvent $event)
    {                
        if($this->getController()->canAdd()) 
        {
            $this->addCommand('new');    
        }   
    }
    
    /**
     * Set the toolbar commands
     * 
     * @return void
     */
    public function addToolbarCommands()
    {
        $entity = $this->getController()->getItem();
                
        if($entity->authorize('edit'))
            $this->addCommand('edit');      
        
        if($entity->authorize('delete'))
            $this->addCommand('delete');        
    }
    
    /**
     * Called before list commands
     * 
     * @return void
     */
    public function addListCommands()
    {
        $entity = $this->getController()->getItem();
        
        if($entity->authorize('edit'))  
            $this->addCommand('edit');
        
        if($entity->authorize('delete'))
            $this->addCommand('delete');
    } 
    
    /**
     * Delete Command for an entity
     *
     * @param LibBaseTemplateObject $command The action object
     *
     * @return void
     */
    protected function _commandDelete($command)
    {
        $entity = $this->getController()->getItem();
    
        $name = KInflector::pluralize($this->getController()->getIdentifier()->name);
        $redirect = 'option=com_'.$this->getIdentifier()->package.'&view='.$name;
    
        $command->append(array('label'=>JText::_('LIB-AN-ACTION-DELETE')))
        ->href(JRoute::_($entity->getURL()))
        ->setAttribute('data-action', 'delete')
        ->setAttribute('data-redirect', JRoute::_($redirect))
        ->class('action-delete');
    }
    
    /**
     * New button toolbar
     *
     * @param LibBaseTemplateObject $command The action object
     *
     * @return void
     */
    protected function _commandNew($command)
    {
        $name   = $this->getController()->getIdentifier()->name;
        $labels = array();
        $labels[] = strtoupper('com-'.$this->getIdentifier()->package.'-toolbar-'.$name.'-new');
        $labels[] = 'New';
        $label = translate($labels);
        $url = 'option=com_'.$this->getIdentifier()->package.'&view='.$name.'&layout=add';
        
        $command
        ->append(array('label'=>$label))
        ->href(JRoute::_($url));
    }
}