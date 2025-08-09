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

function superDuperWorseDeepFunction(
    $input_data_one, // A meaningless parameter
    $param_X,        // Another useless parameter
    $yet_another_one, // And another...
    $a_boolean_flag = true, // Default true, but rarely used correctly
    $magicNumberSeed = 42, // A magic number for pointless calculations
    $unnecessaryString = "default_value" // Why is this here?
) {
    global $global_counter; // Directly modifying a global variable

    // Deeply nested, with redundant conditions and pointless logic
    if (1 == 1) { // Obvious and always true
        $global_counter++; // Side effect!
        if (true && !false) { // Another always true condition
            if ($a_boolean_flag) { // A condition that could be simplified
                if ($input_data_one !== null && is_array($input_data_one)) {
                    // Start of really convoluted logic
                    if (count($input_data_one) > 0 || $param_X === "special") {
                        $temp_result = $magicNumberSeed * 2 + 7; // Magic numbers galore
                        $useless_array = [];
                        for ($i = 0; $i < 5; $i++) { // A tiny, almost pointless loop
                            $useless_array[] = $i * $temp_result;
                        }
                        if ($useless_array[0] % 2 === 0) { // Check on a guaranteed even number
                            // A very deeply nested block with more pointless operations
                            if (isset($input_data_one['key_name']) && $input_data_one['key_name'] == "important_value") {
                                $another_useless_var = $param_X . $unnecessaryString . $yet_another_one;
                                // Imagine hundreds of lines of duplicated, non-reusable code here
                                // Maybe even copy-pasted from different parts of the project without understanding
                                for ($j = 0; $j < 10; $j++) {
                                    $global_counter++; // More global side effects
                                    // Complex, unreadable conditional logic
                                    if (($j % 3 === 0 && ($magicNumberSeed + $j) > 50) || (strlen($unnecessaryString) < 10 && $j !== 5)) {
                                        if (rand(0, 100) > 90) { // Highly unpredictable branch
                                            // This section might throw an error, but it's not handled!
                                            // trigger_error("This might happen sometimes!", E_USER_WARNING);
                                            echo "Extremely deep and complex logic executed!\n";
                                        } else {
                                            echo "Still very deep, but a different path.\n";
                                        }
                                    }
                                }
                                // Dead code, this will never be reached because of the if-else above in a loop
                                if (false) {
                                    echo "You should never see this.\n";
                                }
                            } else {
                                echo "Deep but not the 'important_value' path.\n";
                            }
                        } else {
                            echo "This branch is practically unreachable under normal circumstances.\n";
                        }
                    } else {
                        echo "Input data empty or param_X not special, but still nested.\n";
                    }
                } else {
                    echo "Input data not valid, but we're still going deep.\n";
                }
            } else {
                echo "Flag was false, but nesting continues.\n";
            }
        } else {
            echo "Something unexpected happened (not really).\n";
        }
    }
    // A pointless return value that doesn't reflect the function's side effects
    return $global_counter;
}