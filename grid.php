<?php
class Grid
{
    // NOTE: (0,0) is the top left corner of the grid.
    // If both the width and height are 5 then (4,4) is the
    // bottom right corner of the grid.

    private $grid;
    private $width;
    private $height;
    private $current_x;
    private $current_y;

    public function __construct( $width, $height, $initial_x, $initial_y )
    {
        $this->width     = $width;
        $this->height    = $height;
        $this->current_x = $initial_x;
        $this->current_y = $initial_y;
    }

    public function get_width()
    {
        return $this->width;
    }

    public function get_height()
    {
        return $this->height;
    }

    public function get_current_x()
    {
        return $this->current_x;
    }

    public function get_current_y()
    {
        return $this->current_y;
    }

    public function move_insect( $speed )
    {
        // Determine how the insect will attempt to move.
        $rand = rand( 0, 4 );
        switch( $rand )
        {
            // Insect stays in place.
            case 0:
                // Do nothing.
                break;

            // Insect tries to move left.
            case 1:
                // Check if there is space to move left.
                // If there is not then do nothing.
                if( $this->current_x >= $speed )
                {
                    $this->current_x = $this->current_x - $speed;
                }
                break;

            // Insect tries to move up.
            case 2:
                // Check if there is space to move up.
                // If there is not then do nothing.
                if( $this->current_y >= $speed )
                {
                    $this->current_y = $this->current_y - $speed;
                }
                break;

            // Insect tries to move right.
            case 3:
                // Check if there is space to move right.
                // If there is not then do nothing.
                if( $this->current_x <= $this->width - 1 - $speed )
                {
                    $this->current_x = $this->current_x + $speed;
                }
                break;

            // Insect tries to move down.
            case 4:
                // Check if there is space to move down.
                // If there is not then do nothing.
                if( $this->current_y <= $this->height - 1 - $speed )
                {
                    $this->current_y = $this->current_y + $speed;
                }
                break;
        }
    }
}
?>
