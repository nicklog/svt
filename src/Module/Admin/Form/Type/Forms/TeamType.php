<?php

declare(strict_types=1);

namespace App\Module\Admin\Form\Type\Forms;

use App\Form\Type\Entities\FileEntityType;
use App\Form\Type\Widgets\GenderType;
use App\Form\Type\Widgets\TeamAgeCategoryType;
use App\Form\Type\Widgets\TeamJuniorAgeType;
use App\Form\Type\Widgets\YearGroupType;
use App\Module\Admin\Form\Type\Widgets\PlayerCollectionType;
use App\Module\Admin\Form\Type\Widgets\StaffCollectionType;
use App\Storage\Entity\Team;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Url;

final class TeamType extends AbstractType
{
    /** @inheritDoc */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('enabled', CheckboxType::class, [
                'required' => false,
            ])
            ->add('portraits', CheckboxType::class, [
                'required' => false,
            ])
            ->add('gender', GenderType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('season', YearGroupType::class, [
                'placeholder' => '',
                'required'    => false,
            ])
            ->add('league', TextType::class, [
                'required'    => false,
            ])
            ->add('ageGroup', YearGroupType::class, [
                'required'    => false,
                'placeholder' => '',
            ])
            ->add('juniorAge', TeamJuniorAgeType::class, [
                'required'    => false,
                'placeholder' => '',
            ])
            ->add('ageCategory', TeamAgeCategoryType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('currentMatchday', TextType::class, [
                'required'    => false,
                'constraints' => [
                    new Url(protocols: ['https']),
                ],
            ])
            ->add('handballNetId', TextType::class, [
                'required'    => false,
            ])
            ->add('facebook', TextType::class, [
                'required' => false,
            ])
            ->add('instagram', TextType::class, [
                'required' => false,
            ])
            ->add('emailAddress', EmailType::class, [
                'required' => false,
            ])
            ->add('image', FileEntityType::class, [
                'required' => false,
            ])
            ->add('players', PlayerCollectionType::class, [
                'required'     => false,
            ])
            ->add('staffs', StaffCollectionType::class, [
                'required'     => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Team::class,
        ]);
    }

    public function getParent(): string
    {
        return AbstractForm::class;
    }
}
