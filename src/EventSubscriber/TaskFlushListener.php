<?php

namespace App\EventSubscriber;

use App\Entity\Task;
use App\Repository\ProjectRepository;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Event\PostUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsEntityListener(event: Events::postPersist, method: 'postPersist')]
#[AsEntityListener(event: Events::postUpdate, method: 'postUpdate')]
class TaskFlushListener
{
    public function __construct(private ProjectRepository $projectRepository)
    {
    }

    public function postPersist(PostPersistEventArgs $args):void
    {
        $entity = $args->getObject();

        if ($entity instanceof Task) {
            $this->updateProjectStatusAndDuration($entity);
        }
    }

    public function postUpdate(PostUpdateEventArgs $args):void
    {
        $entity = $args->getObject();

        if ($entity instanceof Task) {
            $this->updateProjectStatusAndDuration($entity);
        }
    }

    public function updateProjectStatusAndDuration(Task $task):void
    {
        $this->projectRepository->updateStatusAndDuration(
            $task->getProject()
        );
    }
}
