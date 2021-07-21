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
            ->add('firstname', TextType::class, array('attr' => array
            ('placeholder' => 'Prénom' , 'style' => 'border-radius:1rem;
            height:2.5rem; background-color:#ebebeb; text-align:center')))
            ->add('lastname', Texttype::class,  array('attr' => array
            ('placeholder' => 'Nom' , 'style' => 'border-radius:1rem;
            height:2.5rem; background-color:#ebebeb; text-align:center')))
            ->add('email',EmailType::class, array('attr' => array
            ('placeholder' => 'Email', 'style' => 'border-radius:1rem;
            height:2.5rem; background-color:#ebebeb; text-align:center')))
            ->add('phone', NumberType::class, array('attr' => array
            ('placeholder' => 'Téléphone', 'style' => 'border-radius:1rem;
            height:2.5rem; background-color:#ebebeb; text-align:center')))
            ->add('message', TextareaType::class, array('attr' => array
            ('placeholder' => 'Message:', 'style' => 'height: 20rem;
            background-color:#ebebeb; border-radius:1rem')))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}
