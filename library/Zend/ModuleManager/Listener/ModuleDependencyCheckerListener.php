<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/zf2 for the canonical source repository
 * @copyright Copyright (c) 2005-2013 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @package   Zend_ModuleManager
 */

namespace Zend\ModuleManager\Listener;

use Zend\ModuleManager\Exception\MissingDependencyModuleException;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;
use Zend\ModuleManager\ModuleEvent;

/**
 * Module resolver listener
 *
 * @category   Zend
 * @package    Zend_ModuleManager
 * @subpackage Listener
 */
class ModuleDependencyCheckerListener
{
    /**
     * @var array of already loaded modules, indexed by module name
     */
    protected $loaded = array();

    /**
     * @param \Zend\ModuleManager\ModuleEvent $e
     *
     * @throws \Zend\ModuleManager\Exception\MissingDependencyModuleException
     */
    public function __invoke(ModuleEvent $e)
    {
        $module = $e->getModule();

        if ($module instanceof DependencyIndicatorInterface || method_exists($module, 'getDependencyModules')) {
            $dependencies = $module->getDependencyModules();

            foreach ($dependencies as $dependencyModule) {
                if (!isset($this->loaded[$dependencyModule])) {
                    throw new MissingDependencyModuleException(
                        sprintf(
                            'Module "%s" depends on module "%s", which was not initialized before it',
                            $e->getModuleName(),
                            $dependencyModule
                        )
                    );
                }
            }
        }

        $this->loaded[$e->getModuleName()] = true;
    }
}
