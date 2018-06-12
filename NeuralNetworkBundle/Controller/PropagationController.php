<?php

namespace Wfo\NeuralNetworkBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Translation\TranslatorInterface;
use Wfo\ComplianceBundle\Form\UpdateExpectedAnnualVolumeType;
use Wfo\Domain\Entity\User;
use Wfo\NeuralNetworkBundle\Entity\Neuron;

class PropagationController extends Controller
{
    /**
     * @Route(
     *     "/propagate",
     *     name="neural-network_propagate",
     *     defaults={"redirecturl": true}
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function propagateAction(Request $request): JsonResponse
    {
        $dispatcher = new EventDispatcher();
        $neuron11 =  new Neuron(11, $dispatcher);
        $neuron12 =  new Neuron(12, $dispatcher);

        $neuron21 =  new Neuron(21, $dispatcher);
        $neuron22 =  new Neuron(22, $dispatcher);

        $neuron21->addConnectionFrom($neuron11);
        $neuron21->addConnectionFrom($neuron12);

        $neuron22->addConnectionFrom($neuron11);
        $neuron22->addConnectionFrom($neuron12);

        $neuron11->setValue(0.1);
        $neuron12->setValue(0.9);

        var_dump($neuron21->value());
        var_dump($neuron22->value());die;

        print 'finished';die;
    }
}
