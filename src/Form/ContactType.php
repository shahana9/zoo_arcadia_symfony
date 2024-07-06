<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Mime\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'E-mail',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre email']),
                 new Email(['message' => 'Veuillez entrer une adresse email valide.'])
                ],
            'attr' => ['placeholder' => 'example@domain.com']
        ])

            ->add('title', TextType::class, [
                'label' => 'Titre',
                'constraints' => [
                new NotBlank(['message' => 'Veuillez entrer un titre.']),
                new Length(['max' => 255, 'maxMessage' => 'Le titre ne peut pas dépasser 255 caractères.'])
                ],
            ])
            ->add('description', TextareaType::class, [
                'label' => 'description',
                'constraints' => [
                    new NotBlank(['message' => 'Veuillez entrer votre message.']),
                    new Length(['max' => 2000, 'maxMessage' => 'Le message ne peut pas dépasser 2000 caractères.'])
                ],
                'attr' => ['placeholder' => 'Votre message']
            ])
           ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // 'data_class' => Contact::class,
        ]);
    }
}
