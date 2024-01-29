<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;
use Symfony\Component\HttpKernel\KernelEvents;

final class ExceptionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            KernelEvents::RESPONSE => ['changeStatusCode'],
        ];
    }

    public function changeStatusCode(ResponseEvent $event): void
    {
        $response = $event->getResponse();
        $statusCode = $response->getStatusCode();
        $content = json_decode($response->getContent());

        if (null !== $content) {
            if ($statusCode >= 300) {
                $response->setStatusCode(200);
                $content->__code = -1;
                $content->__validation_errors = [$content->detail];
            } else {
                $content->__code = 0;
                $content->__validation_errors = [];
            }
            $response->setContent(json_encode($content));
        }
    }
}
