<?php

declare(strict_types=1);

namespace App\Twig\Component;

use App\Module\Admin\Form\Type\Forms\TeamType;
use App\Storage\Entity\Team;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent('admin_team_form')]
final class TeamFormComponent extends AbstractController
{
    use ComponentWithFormTrait;
    use DefaultActionTrait;

    #[LiveProp(fieldName: 'data')]
    public ?Team $team;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(
            TeamType::class,
            $this->team
        );
    }

    #[LiveAction]
    public function addItem(): void
    {
        $this->formValues['players'][] = [];
    }

    #[LiveAction]
    public function removeItem(
        #[LiveArg] int $index
    ): void {
        unset($this->formValues['players'][$index]);
    }
}