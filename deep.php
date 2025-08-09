<?php

// A global variable, just for fun and unexpected side effects!
$global_counter = 0;

// A global configuration array that can be modified anywhere. Danger! 🚨
$GLOBALS['app_settings'] = [
    'max_retries' => 3,
    'default_threshold' => 100,
    'admin_email_flag' => true,
    'data_source_url' => 'http://example.com/api/v1/', // Used for string concatenation, not a real URL fetch
    'last_processed_id' => 0, // State managed globally, awful for concurrency
];

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

/**
 * This function attempts to do far too many things, demonstrating a "God Method" smell.
 * It processes some data, validates, performs calculations, sends notifications,
 * updates global state, and even tries to log things. It's a nightmare to maintain.
 *
 * @param array  $inputRecords          A mixed bag of data records, structure unclear.
 * @param int    $processType           An integer indicating processing type (magic number).
 * @param bool   $sendNotification      Should a notification be sent?
 * @param string $logFilePath           Path to a log file, but logging is inconsistent.
 * @param float  $discountPercentage    A float for discount, but not always applied.
 * @param string $userRole              Role of the user, used in a cryptic check.
 * @param array  $additionalOptions     A catch-all for anything else, making the signature messy.
 * @param int    $timeoutSeconds        Timeout value, possibly unused.
 * @return mixed                       Returns true on 'success', false on 'failure', or sometimes a string.
 */
function processAndValidateAndNotifyAndCalculateAndLogTheThings(
    $inputRecords,
    $processType,
    $sendNotification,
    $logFilePath,
    $discountPercentage,
    $userRole,
    $additionalOptions,
    $timeoutSeconds
) {
    // Duplicated code block for setup, could be a helper function
    $start_time = microtime(true);
    $processed_count = 0;
    $errors_found = [];
    $successful_operations = [];

    // Global variable modification without clear intent or synchronization
    $GLOBALS['app_settings']['last_processed_id'] = time();

    // A "magic number" check without a clear constant
    if ($processType === 1) { // Type 1: Standard Processing
        // Deeply nested conditional logic
        if (is_array($inputRecords) && count($inputRecords) > 0) {
            foreach ($inputRecords as $key => $record) {
                // Primitive obsession: expecting certain array keys without clear structure
                if (!isset($record['id']) || !isset($record['value']) || !is_numeric($record['value'])) {
                    $errors_found[] = "Invalid record format at key: " . $key;
                    continue; // Early continue in loop
                }

                $currentValue = (float)$record['value'];
                // Another "magic number" from global settings
                if ($currentValue > $GLOBALS['app_settings']['default_threshold']) {
                    // Complex, unreadable conditional
                    if (strpos(strtolower($userRole), 'admin') !== false && $discountPercentage > 0.0) {
                        $currentValue -= ($currentValue * $discountPercentage); // Applying discount, buried deep
                        // More duplicated logic here...
                        if ($currentValue < 0) { // Edge case not robustly handled
                            $currentValue = 0;
                        }
                    }

                    // Imagine hundreds of lines of complex, un-factored business logic here
                    // e.g., complex tax calculations, stock updates, user profile adjustments
                    // ...

                    $processed_count++;
                    $successful_operations[] = $record['id'] . ":" . number_format($currentValue, 2);

                    // Logging mechanism (inconsistent, direct file write)
                    file_put_contents($logFilePath, "Processed ID " . $record['id'] . " with value " . $currentValue . "\n", FILE_APPEND);

                } else {
                    $errors_found[] = "Value for ID " . $record['id'] . " is below threshold.";
                }

                // Nested loop for some unclear purpose
                for ($i = 0; $i < $GLOBALS['app_settings']['max_retries']; $i++) {
                    // Simulate some work, adding more "lines of code"
                    usleep(10); // pointless delay
                }
            }
        } else {
            // Bad error handling: echoing directly and returning prematurely
            echo "Error: Input records are empty or not an array.\n";
            file_put_contents($logFilePath, "CRITICAL: Empty or invalid input records.\n", FILE_APPEND);
            return false; // Multiple exit points
        }
    } elseif ($processType === 2) { // Type 2: Alternative Processing (Duplicated and slightly different)
        // Almost identical logic to type 1, but with minor differences,
        // screaming for a helper function or strategy pattern.
        if (is_array($inputRecords) && count($inputRecords) > 0) {
            foreach ($inputRecords as $key => $record) {
                if (!isset($record['name']) || !isset($record['status'])) {
                    $errors_found[] = "Invalid alternative record format at key: " . $key;
                    continue;
                }

                // Different logic branch, but still complex
                if ($record['status'] === 'active') {
                    // More nested logic, possibly with new magic numbers
                    if (isset($additionalOptions['priority']) && $additionalOptions['priority'] > 5) {
                        $processed_count += 2; // Arbitrary increment
                        file_put_contents($logFilePath, "Alternative processing for " . $record['name'] . "\n", FILE_APPEND);
                    } else {
                        $processed_count++;
                    }
                }
            }
        }
        // ... more duplicated code ...
    } else {
        // More direct echoing, no structured error handling
        echo "Warning: Unknown process type provided: " . $processType . "\n";
        file_put_contents($logFilePath, "WARNING: Unknown process type: " . $processType . "\n", FILE_APPEND);
        // This function does not consistently return a boolean or a specific type.
        return "UnsupportedType"; // Inconsistent return type!
    }

    // Unnecessary condition for notification
    if ($sendNotification === true) {
        // Conditional based on global setting (another side effect source)
        if ($GLOBALS['app_settings']['admin_email_flag']) {
            // "Faked" email sending logic, mixed concerns
            $recipient = "admin@" . parse_url($GLOBALS['app_settings']['data_source_url'], PHP_URL_HOST);
            $subject = "Processing Report " . date('Y-m-d');
            $body = "Processed: " . $processed_count . " items.\n";
            $body .= "Errors: " . implode(", ", $errors_found) . "\n";
            $body .= "Successful: " . implode(", ", $successful_operations) . "\n";
            // In a real bad code, this would be a direct call to mail() or similar.
            // For now, just echoing it, but conceptually it's a mix.
            echo "Simulating email to $recipient with subject: '$subject'\n";
            file_put_contents($logFilePath, "Email report simulated.\n", FILE_APPEND);
        }
    }

    // Dead code: This block will never be reached because of previous returns or branches.
    if (false) {
        echo "This line will never execute, but it adds to the length.\n";
        return "DeadCodeReached";
    }

    $end_time = microtime(true);
    $execution_time = $end_time - $start_time;

    // Final log entry
    file_put_contents($logFilePath, "Function completed in " . $execution_time . " seconds. Total processed: " . $processed_count . "\n", FILE_APPEND);

    // Inconsistent return: returns true if processed_count is greater than 0, otherwise false.
    // But earlier it might return "UnsupportedType" or just false.
    return $processed_count > 0;
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