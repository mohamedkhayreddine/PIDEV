<?php

namespace MyApp\GestionAutoEcolesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use MyApp\UserBundle\Entity\AutoEcoles;
class AjaxAutocompleteController extends Controller
{
    public function updateDataAction(Request $request)
    {
        $data = $request->get('input');

        $em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(''
            . 'SELECT c.id, c.name '
            . 'FROM GestionAutoEcolesBundle:AutoEcoles c '
            . 'WHERE c.nom LIKE :data '
            . 'ORDER BY c.nom ASC'
        )
            ->setParameter('data', '%' . $data . '%');
        $results = $query->getResult();

        $countryList = '<ul id="matchList">';
        foreach ($results as $result) {
            $matchStringBold = preg_replace('/('.$data.')/i', '<strong>$1</strong>', $result['name']); // Replace text field input by bold one
            $countryList .= '<li id="'.$result['name'].'">'.$matchStringBold.'</li>'; // Create the matching list - we put maching name in the ID too
        }
        $countryList .= '</ul>';

        $response = new JsonResponse();
        $response->setData(array('countryList' => $countryList));
        return $response;
    }
}
