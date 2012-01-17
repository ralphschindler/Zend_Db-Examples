<?php


function assert_example_works($expression, $continue_if_true) {
    if ($expression) {
        if ($continue_if_true) {
            return;
        } else {
            echo 'It works!';
            exit(0);
        }
    } else {
        echo 'It DOES NOT work!';
        exit(0);
    }
}
