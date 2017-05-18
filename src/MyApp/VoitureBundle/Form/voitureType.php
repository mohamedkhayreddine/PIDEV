<?php

namespace MyApp\VoitureBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class voitureType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {




        $builder
            ->add('serie')
            ->add('marque')
            ->add('couleur',ChoiceType::class,array(
            'choices'=>array(
                'Rouge'=>"Rouge",
                'Noir'=>"Noir",
                'Gris'=>"Gris",
                'Blanc'=>"Blanc"
            ),
                'required'    => false,
                'placeholder' => 'choisir la couleur',
        ))
            ->add('dateEntretient')
            ->add('model')
            //->add('file')
            //->setMethod('POST')
           ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // optional, default is true
                'download_link' => true, // optional, default is true

            ])
          ;




    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\VoitureBundle\Entity\voiture'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_voiturebundle_voiture';
    }


}
