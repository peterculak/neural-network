<?php

namespace Wfo\NeuralNetworkBundle\Entity;

use Wfo\NeuralNetworkBundle\Event\NeuronFired;

interface NeuronInterface
{
    public function id(): string;

    public function addConnectionFrom(NeuronInterface $neuron);

    public function setValue(float $value);

    public function onFire(NeuronFired $event);

    public function value();
}
