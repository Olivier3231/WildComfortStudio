<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class, [
                'label' => 'Prénom *'
            ])
            ->add('lastname', Texttype::class, [
                'label' => 'Nom *'
            ])
            ->add('email',EmailType::class, [
                'label' => 'Email *'
            ])
            ->add('phone', NumberType::class, [
                'label' => 'Téléphone *', 
            ] )
            ->add('message', TextareaType::class, [
                'label' => 'Message *'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
