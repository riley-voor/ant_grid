<?php
class Visualizer
{
    public static function draw( $simulator, $iteration, $step )
    {
        $width     = $simulator->get_width();
        $height    = $simulator->get_height();
        $current_x = $simulator->get_current_x();
        $current_y = $simulator->get_current_y();

        echo( "-----------------------------------------------------------\n" );
        echo( "\n" );
        echo( 'Iteration: ' . $iteration . "\n" );
        if( $step === 0 )
        {
            echo( "Initial Position\n" );
        }
        else
        {
            echo( 'Step: ' . $step . "\n" );
        }
        echo( 'Current Location: ' .
              Visualizer::build_location_string( $simulator->get_current_x(), $simulator->get_current_y() ) .
              "\n"
        );
        echo( "\n" );
        for( $y = 0; $y < $height; $y++ )
        {
            echo( '|' );
            for( $x = 0; $x < $width; $x++ )
            {
                if( $x === $current_x && $y === $current_y )
                {
                    echo( 'X|' );
                }
                else
                {
                    echo( ' |' );
                }
            }

            echo( "\n" );
        }
        echo( "\n" );
    }

    public static function dump_stats( $stat_collector, $width, $height, $iterations )
    {
        $stats = $stat_collector->compile_stats( $iterations );

        echo( "-----------------------------------------------------------\n" );
        echo( "Final Stats:\n" );
        echo( "-----------------------------------------------------------\n" );
        echo( "\n" );
        for( $y = 0; $y < $height; $y++ )
        {
            for( $x = 0; $x < $width; $x++ )
            {
                echo( Visualizer::build_location_string( $x, $y ) . ': ' );

                if( array_key_exists( $x, $stats ) && array_key_exists( $y, $stats[$x] ) )
                {
                    echo( $stats[$x][$y] . "%\n" );
                }
                else
                {
                    echo( "0%\n" );
                }
            }
        }
        echo( "\n" );
    }

    public static function dump_final_location( $simulator )
    {
        echo( "\n" );
        echo( "-----------------------------------------------------------\n" );
        echo( 'Final location: ' .
              Visualizer::build_location_string( $simulator->get_current_x(), $simulator->get_current_y() ) .
              "\n"
        );
        echo( "-----------------------------------------------------------\n" );
        echo( "\n" );
        echo( "\n" );
    }

    // Return a string that shows the current x and y location.
    public static function build_location_string( $x, $y )
    {
        return '(' . $x. ',' . $y. ')';
    }
}
?>
