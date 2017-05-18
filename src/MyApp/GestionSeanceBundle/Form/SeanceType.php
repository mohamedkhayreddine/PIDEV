<?php

namespace MyApp\GestionSeanceBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SeanceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('dateSeance')->
        add('heureDebut')->
        add('heureFin')->
        add('idMoniteur',EntityType::class,array(
            'class'=>'MyApp\UserBundle\Entity\User',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('n')
                    ->where('n.roles= :fonction')->setParameter('fonction','a:1:{i:0;s:13:"ROLE_MONITEUR";}')
                    ;
            },
            'choice_label'=>'prenom',
        ))->
        add('idCandidat',EntityType::class,array(
            'class'=>'MyApp\UserBundle\Entity\User',
            'query_builder' => function(EntityRepository $er) {
                return $er->createQueryBuilder('n')
                    ->where('n.roles= :fonction')->setParameter('fonction','a:1:{i:0;s:11:"ROLE_CLIENT";}')
                    ;
            },
            'choice_label'=>'prenom',
        ))->
        add('Enregistrer',SubmitType::class);;
    }
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MyApp\GestionSeanceBundle\Entity\Seance'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'myapp_gestionseance_seance';
    }


}
