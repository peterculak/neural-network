<?php

namespace Wfo\NeuralNetworkBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Wfo\NeuralNetworkBundle\Entity\NeuronInterface;

class NeuronFired extends Event
{
    /**
     * @var NeuronInterface
     */
    private $neuron;

    private function __construct(NeuronInterface $neuron)
    {
        $this->neuron = $neuron;
    }

    public static function createFromFiredNeuron(NeuronInterface $neuron): self
    {
        return new self($neuron);
    }

    public function neuron(): NeuronInterface
    {
        return $this->neuron;
    }
}
