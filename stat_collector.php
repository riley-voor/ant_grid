<?php
class StatCollector
{
    private $stats;

    public function __construct()
    {
        $this->stats = [];
    }

    public function record_stat( $x, $y )
    {
        if( !array_key_exists( $x, $this->stats ) )
        {
            $this->stats[$x] = [];
        }

        if( !array_key_exists( $y, $this->stats[$x] ) )
        {
            $this->stats[$x][$y] = 0;
        }

        $this->stats[$x][$y] = $this->stats[$x][$y] + 1;
    }

    public function compile_stats( $iterations )
    {
        $percentages = [];
        foreach( array_keys( $this->stats ) as $x )
        {
            if( !array_key_exists( $x, $percentages ) )
            {
                $percentages[$x] = [];
            }

            foreach( array_keys( $this->stats[$x] ) as $y )
            {
                $percentages[$x][$y] = round( ( $this->stats[$x][$y] / $iterations ) * 100, 2 );
            }
        }

        return $percentages;
    }
}
?>
