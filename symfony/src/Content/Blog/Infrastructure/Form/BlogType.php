<?php

declare(strict_types=1);

namespace App\Content\Blog\Infrastructure\Form;

use App\UserProfile\Domain\Model\UserProfile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add(
                'title',
                TextType::class,
                [
                    'label' => 'Title',
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Body',
                ]
            )
            ->add(
                'author',
                EntityType::class,
                array_merge(
                    [
                        // @TODO only allow to choose from user profiles that currently logged in user has rights to
                        'label' => 'Choose your user profile',
                        'class' => UserProfile::class,
                        'choice_label' => 'name',
                        'required' => true,
                        'choice_translation_domain' => true,
                        'constraints' => [
                            new NotBlank(['message' => 'User profile is required.']),
                        ],
                    ],
                )
            )
            ->add(
                'submit',
                SubmitType::class,
            );
    }
}
