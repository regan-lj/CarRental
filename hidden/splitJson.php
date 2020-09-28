<?php

/**
 * Delete element at given index
 *
 * @param $array array the original array
 * @param $index int the index of deleted element
 * @return array the new array
 */
function splitJson($array, $index) {
    // Get all elements before deleted element
    $updated = array_slice($array, 0, $index);
    // Add all elements after deleted element
    $after = array_slice($array, $index+1);
    foreach ($after as $element) {
        array_push($updated, $element);
    }
    return $updated;
}