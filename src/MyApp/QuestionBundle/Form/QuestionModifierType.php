<?php
/**
 * Created by PhpStorm.
 * User: TOSHIBA
 * Date: 09/04/2017
 * Time: 22:20
 */


namespace MyApp\QuestionBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionModifierType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('modifier',SubmitType::class)->add('typequest',EntityType::class,array('class'=>'MyApp\QuestionBundle\Entity\TypeQuestion','choice_label'=>'typequest'))
            ->add('imageFile',FileType::class,array('label' => 'Brochure (JPG file)','required'=>false));
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