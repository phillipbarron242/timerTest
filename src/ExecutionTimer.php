<?php

class ExecutionTimer
{
    private $timerFactory;
    private $timers;

    /**
     * @param TimerFactory $timerFactory
     */
    public function __construct(TimerFactory $timerFactory)
    {
        $this->timerFactory = $timerFactory;
        $this->timers = [];
    }

    /**
     * @param $name
     * @throws DuplicateTimerNameException
     */
    public function addTimer($name)
    {
        if ($this->timerNameExists($name)){
            throw new DuplicateTimerNameException();
        }
        $this->timers[$name] = $this->timerFactory->create($name);
    }

    /**
     * @param $name
     * @return bool
     */
    private function timerNameExists($name)
    {
        if(array_key_exists($name, $this->timers)){
            return true;
        }
        return false;
    }

    /**
     * @param $timerName
     * @throws TimerNameDoesNotExistException
     */
    public function startTimer($timerName)
    {
        if (! $this->timerNameExists($timerName)){
            throw new TimerNameDoesNotExistException();
        }
        $this->timers[$timerName]->start();
    }

    /**
     * @param $timerName
     * @throws TimerNameDoesNotExistException
     */
    public function stopTimer($timerName)
    {
        if (! $this->timerNameExists($timerName)){
            throw new TimerNameDoesNotExistException();
        }
        $this->timers[$timerName]->stop();
    }
}
