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
use Symfony\Component\Validator\Constraints\Length;
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
                    'constraints' => [
                        new NotBlank(['message' => 'Title is required.']),
                        new Length([
                            'min' => 10,
                            'max' => 255,
                            'minMessage' => 'Title is too short. 10 characters is minimum.',
                            'maxMessage' => 'Title is too long. 255 characters is maximum.',
                        ]),
                    ],
                ]
            )
            ->add(
                'description',
                TextareaType::class,
                [
                    'label' => 'Body',
                    'constraints' => [
                        new NotBlank(),
                        new Length([
                            'min' => 100,
                            'minMessage' => 'Body is too short. Blog posts are supposed to have between 500-2000 words. 100 characters is minimum.',
                        ]),
                    ],
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
