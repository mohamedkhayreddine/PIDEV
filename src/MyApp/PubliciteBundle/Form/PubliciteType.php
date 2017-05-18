<?php

namespace MyApp\PubliciteBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
class PubliciteType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('description')
            //->add('dateDepo')
           // ->add('validation')
           // ->add('datePub')
           // ->add('dateAnnulation')
           // ->add('idowner')
            ->add('imageFile', VichImageType::class, [
                'required' => false,
                'allow_delete' => true, // optional, default is true
                'download_link' => true, // optional, default is true
            ])->add('ajouter',SubmitType::class)
           ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\PubliciteBundle\Entity\Publicite'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_publicitebundle_publicite';
    }


}
