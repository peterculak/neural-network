<?php

namespace Wfo\NeuralNetworkBundle\Entity;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Wfo\NeuralNetworkBundle\Event\NeuronFired;

class Neuron implements NeuronInterface
{
    private $id;

    /**
     * @var \SplObjectStorage
     */
    private $connections;

    /**
     * @var float
     */
    private $value;

    /**
     * @var EventDispatcherInterface
     */
    private $dispatcher;

    public function __construct(string $id, EventDispatcherInterface $dispatcher)
    {
        $this->id = $id;
        $this->dispatcher = $dispatcher;
        $this->connections = new \SplObjectStorage();
    }

    /**
     * @param NeuronInterface $neuron
     * @param null $weight
     */
    public function addConnectionFrom(NeuronInterface $neuron, $weight = null)
    {
        $this->connections->attach(Connection::create($neuron, $weight));

        $this->dispatcher->addListener(
            $neuron->id(),
            [
                $this,
                'onFire',
            ]
        );
    }

    public function onFire(NeuronFired $event)
    {
        var_dump('on fire: ' . $this->id);
        foreach ($this->connections as $connection) {
            if ($connection->containsNeuron($event->neuron())) {
                $connection->setValue($event->neuron()->value());
            }
        }

        //fire when all connections fired
    }

    public function id(): string
    {
        return $this->id;
    }

    public function value(): float
    {
        if ($this->connections && $this->connections->count()) {
            $value = 0.0;
            foreach ($this->connections as $connection) {
                $value += $connection->value();
            }

            return $value;
        }

        return $this->value;
    }

    public function setValue(float $value)
    {
        $this->value = $value;
        $this->fire();
    }

    private function fire()
    {
        var_dump('fire: ' . $this->id);
        $this->dispatcher->dispatch($this->id, NeuronFired::createFromFiredNeuron($this));
    }
}
