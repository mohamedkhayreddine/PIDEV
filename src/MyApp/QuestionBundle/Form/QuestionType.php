<?php

namespace MyApp\QuestionBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('Ajouter',SubmitType::class)->add('contenu',TextareaType::class)->add('reponsecorrect')
            ->add('choix1')->add('choix2')
            ->add('choix3')->add('typequest',EntityType::class,array('class'=>'MyApp\QuestionBundle\Entity\TypeQuestion','choice_label'=>'typequest'))
            ->add('imageFile',FileType::class,array('label' => 'Brochure (JPG file)'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\QuestionBundle\Entity\Question'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_questionbundle_question';
    }


}
