<?php
class Insect
{
    private $speed;

    public function __construct( $speed )
    {
        $this->speed = $speed;
    }

    public function get_speed()
    {
        return $this->speed;
    }
}
?>
