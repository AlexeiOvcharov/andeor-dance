<?php

namespace AppBundle\Form\Index;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;


class FeedbackForm extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add(
            'text',
            TextareaType::class,
            [
                'attr' => ['placeholder' => 'Напишите ваш вопрос, отзыв или заявку на участие', 'style' => 'height:100px'],
                'constraints' => [
                    new NotBlank()
                ]
            ]
        );
        $builder->add(
            'name',
            TextType::class,
            [
                'label' => '',
                'attr' => ['placeholder' => 'Имя']
            ]
        );
        $builder->add(
            'email',
            EmailType::class,
            [
                'attr' => [
                    'placeholder' => 'Телефон или email',
                    'autocomplete' => 'off',
                    'x-autocompletetype' => 'off'
                ],
                'constraints' => [
                    new NotBlank(),
                    new Length(['max' => 200])
                ]
            ]
        );
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'attr' => [
                    'novalidate' => 'novalidate'
                ]
            ]
        );
    }
}
