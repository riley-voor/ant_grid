<?php

// Require files
require( 'grid.php'           );
require( 'insect.php'         );
require( 'simulator.php'      );
require( 'stat_collector.php' );
require( 'visualizer.php'     );

// TODO implement a help param

// TODO still need to test with all the different param combos to make sure stuff like the beetle and different width and heights and so on all work as expected.

// Get the command line params
$params              = getopt('vbsd:w:h:x:y:i:t:');
$visualize_output    = array_key_exists( 'v', $params );
$use_beetle          = array_key_exists( 'b', $params );
$show_stats          = array_key_exists( 's', $params );
$param_step_delay    = array_key_exists( 'd', $params ) ? $params['d'] : null;
$param_width         = array_key_exists( 'w', $params ) ? $params['w'] : null;
$param_height        = array_key_exists( 'h', $params ) ? $params['h'] : null;
$param_initial_x     = array_key_exists( 'x', $params ) ? $params['x'] : null;
$param_initial_y     = array_key_exists( 'y', $params ) ? $params['y'] : null;
$param_iterations    = array_key_exists( 'i', $params ) ? $params['i'] : null;
$param_step_to_track = array_key_exists( 't', $params ) ? $params['t'] : null;

// Verify that params are valid.
// We want to output the help text and exit the script if someone calls this with an invalid param.
// TODO

// Param command line params and set up initial values.
$ant_speed    = 1;
$beetle_speed = 2;
$insect_speed = $use_beetle ? $beetle_speed : $ant_speed;

// NOTE: the step delay is in seconds
$step_delay = !is_null( $param_step_delay ) ? $param_step_delay : 0;

$default_width  = 5;
$default_height = 5;
$width          = !is_null( $param_width ) ? $param_width : $default_width;
$height         = !is_null( $param_height) ? $param_height : $default_height;

$initial_x = !is_null( $param_initial_x ) ? $param_initial_x : 2;
$initial_y = !is_null( $param_initial_y ) ? $param_initial_y : 2;

$iterations = !is_null( $param_iterations ) ? $param_iterations : 1;

// We want stats on where the insect is after '15 seconds' (15 steps) by default.
// If you wanted to check the stats on where the insect is likely to be
// after 1 hour then you would provide 3600 for this param.
$step_to_track = !is_null( $param_step_to_track ) ? $param_step_to_track : 15;

// Initialize our objects.
$stat_collector = new StatCollector( $step_to_track );

// Run a whole simulation a number of times equal to the iterations.
for( $iteration = 0; $iteration < $iterations; $iteration++ )
{
    // Initialize a new simulator.
    $simulator = new Simulator( $stat_collector, $width, $height, $initial_x, $initial_y, $insect_speed );

    // Draw the current state of the simulator if necessary.
    if( $visualize_output )
    {
        Visualizer::draw( $simulator, $iteration + 1, 0 );
    }

    // Run the simulator until we reach the step count whose stats we want to track.
    for( $step = 0; $step < $step_to_track; $step++ )
    {
        // Step the simulator.
        $simulator->step( $step );

        // Draw the current state of the simulator if necessary.
        if( $visualize_output )
        {
            Visualizer::draw( $simulator, $iteration + 1, $step + 1 );
        }

        // Sleep for the amount of time specified by the step delay.
        sleep( $step_delay );
    }

    // Record the final location at the end of each full simulation.
    $stat_collector->record_stat( $simulator->get_current_x(), $simulator->get_current_y() );

    // Show the final location for this iteration of the simulation.
    if( $visualize_output )
    {
        Visualizer::dump_final_location( $simulator );
    }
}

// Dump the stats for this simulation.
if( $show_stats )
{
    Visualizer::dump_stats( $stat_collector, $width, $height, $iterations );
}
?>
