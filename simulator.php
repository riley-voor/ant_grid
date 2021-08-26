<?php
class Simulator
{
    private $grid;
    private $insect;
    private $stat_collector;

    public function __construct( $stat_collector, $width, $height, $initial_x, $initial_y, $insect_speed )
    {
        $this->stat_collector = $stat_collector;
        $this->grid           = new Grid( $width, $height, $initial_x, $initial_y );
        $this->insect         = new Insect( $insect_speed );
    }

    public function step()
    {
        // Move the insect on the grid.
        $this->grid->move_insect( $this->insect->get_speed() );
    }

    public function get_width()
    {
        return $this->grid->get_width();
    }

    public function get_height()
    {
        return $this->grid->get_height();
    }

    public function get_current_x()
    {
        return $this->grid->get_current_x();
    }

    public function get_current_y()
    {
        return $this->grid->get_current_y();
    }
}
?>
