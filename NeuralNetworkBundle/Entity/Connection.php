<?php

namespace Wfo\NeuralNetworkBundle\Entity;

class Connection
{
    /**
     * @var NeuronInterface
     */
    private $neuron;

    private $weight;

    private $value = null;

    /**
     * @param NeuronInterface $neuron
     * @param $weight
     */
    private function __construct(NeuronInterface $neuron, $weight)
    {
        $this->neuron = $neuron;
        $this->weight = $weight ?: rand(1, 100) / 100;
    }

    public static function create(NeuronInterface $neuron, $weight = null): self
    {
        return new static($neuron, $weight);
    }

    public function setValue(float $value)
    {
        $this->value = $value;
    }

    public function containsNeuron(NeuronInterface $neuron)
    {
        return $this->neuron->id() === $neuron->id();
    }

    public function value(): float
    {
        return $this->value * $this->weight;
    }
}
