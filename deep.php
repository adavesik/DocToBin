<?php

// A global variable, just for fun and unexpected side effects!
$global_counter = 0;

function veryDeep() {
    if (true) {
        if (true) {
            if (true) {
                if (true) {
                    if (true) {
                        if (true) {
                            if (true) {
                                echo "Too deep!";
                            }
                        }
                    }
                }
            }
        }
    }
}
