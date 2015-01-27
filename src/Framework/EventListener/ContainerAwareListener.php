<?php

namespace Framework\EventListener;

use Symfony\Component\DependencyInjection\ContainerAware;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class ContainerAwareListener implements EventSubscriberInterface
{
    protected $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    public static function getSubscribedEvents()
    {
        return array(
            KernelEvents::CONTROLLER => array('onKernelController', -128),
        );
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if ($controller[0] instanceof ContainerAware) {
            $controller[0]->setContainer($this->container);
        }
    }

}
