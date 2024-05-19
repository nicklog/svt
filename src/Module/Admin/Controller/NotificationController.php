<?php

declare(strict_types=1);

namespace App\Module\Admin\Controller;

use App\Module\Admin\Crud\CrudConfigBuilder;
use App\Module\Admin\Crud\Handler\FullHandler;
use App\Module\Admin\Form\Type\Forms\NotificationType;
use App\Storage\Entity\Notification;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

/** @template-extends AbstractCrudController<Notification> */
#[AsController]
#[Route('/notification', name: 'notification_')]
final class NotificationController extends AbstractCrudController
{
    use FullHandler;

    protected function configureCrudConfig(CrudConfigBuilder $builder): void
    {
        $builder->setMandatory(
            Notification::class,
            'notification',
        );
    }

    protected function getFormType(Request $request, object|null $object = null): string
    {
        return NotificationType::class;
    }
}
