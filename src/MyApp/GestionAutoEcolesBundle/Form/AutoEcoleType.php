<?php

namespace MyApp\GestionAutoEcolesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Vich\UploaderBundle\Form\Type\VichImageType;


use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\Form\Extension\Core\Type\FileType;

class AutoEcoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('numTel')->add('eMail')->add('matriculeFiscal')->add('idVille',EntityType::class,array('class'=>'MyApp\UserBundle\Entity\Ville','choice_label'=>'nom'));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\UserBundle\Entity\AutoEcoles'
        ));
    }

    public function getBlockPrefix()
    {
        return 'myapp_userbundle_autoecoles';
    }
}
