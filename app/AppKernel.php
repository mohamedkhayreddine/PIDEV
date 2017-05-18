<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = [
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new AppBundle\AppBundle(),
            new MyApp\UserBundle\MyAppUserBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new MyApp\GestionSeanceBundle\MyAppGestionSeanceBundle(),
            new MyApp\CarteBundle\MyAppCarteBundle(),
            new MyApp\GestionReclamationBundle\MyAppGestionReclamationBundle(),
            new Knp\Bundle\SnappyBundle\KnpSnappyBundle(),
            new Ob\HighchartsBundle\ObHighchartsBundle(),
            new Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new MyApp\EventsBundle\MyAppEventsBundle(),
            new Vich\UploaderBundle\VichUploaderBundle(),
            new Nomaya\SocialBundle\NomayaSocialBundle(),
            new MyApp\AffectationBundle\MyAppAffectationBundle(),
            new MyApp\paiementBundle\MyApppaiementBundle(),
            new MyApp\VoitureBundle\MyAppVoitureBundle(),
            new MyApp\QuestionBundle\MyAppQuestionBundle(),
            new MyApp\GestionAutoEcolesBundle\MyAppGestionAutoEcolesBundle(),
            new MyApp\GestionVilleBundle\MyAppGestionVilleBundle(),
            new MyApp\CoursBundle\MyAppCoursBundle(),
            new MyApp\PubliciteBundle\MyAppPubliciteBundle(),
            new MyApp\StatBundle\MyAppStatBundle(),
            new MyApp\GestionOffresBundle\MyAppGestionOffresBundle(),
        ];

        if (in_array($this->getEnvironment(), ['dev', 'test'], true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function getRootDir()
    {
        return __DIR__;
    }

    public function getCacheDir()
    {
        return dirname(__DIR__).'/var/cache/'.$this->getEnvironment();
    }

    public function getLogDir()
    {
        return dirname(__DIR__).'/var/logs';
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
