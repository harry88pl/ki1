<?php

class matrix {
    public static function dot($matrix1, $matrix2) {
        $rows1 = count($matrix1);
        $columns1 = count($matrix1[0]);
        $rows2 = count($matrix2);
        $columns2 = count($matrix2[0]);

        if ($columns1 !== $rows2) {
            // Rzucanie wyjątku lub obsługa błędu, gdy wymiary macierzy są nieprawidłowe
            throw new Exception("Nieprawidłowe wymiary macierzy(2).");
        }

        $result = array();

        for ($i = 0; $i < $rows1; $i++) {
            $row = array();

            for ($j = 0; $j < $columns2; $j++) {
                $element = 0;

                for ($k = 0; $k < $columns1; $k++) {
                    $element += $matrix1[$i][$k] * $matrix2[$k][$j];
                }

                $row[] = $element;
            }

            $result[] = $row;
        }

        return $result;
    }
    public static function multiply($matrix1, $matrix2) {
        $rows1 = count($matrix1);
        $columns1 = count($matrix1[0]);
        $rows2 = count($matrix2);
        $columns2 = count($matrix2[0]);
        if ($columns1 !== $columns2 || $rows1 !== $rows2) {
            throw new Exception("Nieprawidłowe wymiary macierzy.");
        }
        $result = array();
        for ($i = 0; $i < $rows1; $i++) {
            $row = array();

            for ($j = 0; $j < $columns2; $j++) {
                $element = 0;

                for ($k = 0; $k < $columns1; $k++) {
                    $element += $matrix1[$i][$k] * $matrix2[$k][$j];
                }

                $row[] = $element;
            }

            $result[] = $row;
        }
        return $result;
    }
    public static function multiplyAdrian($matrix1, $matrix2) {
        $rows1 = count($matrix1);
        $columns1 = count($matrix1[0]);
        $rows2 = count($matrix2);
        $columns2 = count($matrix2[0]);
        if ($columns1 !== $columns2 || $rows1 !== $rows2) {
            throw new Exception("Nieprawidłowe wymiary macierzy.");
        }
        $result = array();
        for ($i = 0; $i < $rows1; $i++) {
            $row = array();
            for ($j = 0; $j < $columns2; $j++) {
                $element = 0;
                $element += $matrix1[$i][$j] * $matrix2[$i][$j];
                $row[] = $element;
            }
            $result[] = $row;
        }
        return $result;
    }
    public static function divide() {

    }

    public static function subtract($matrix1, $matrix2) {
        $result = array();
        for ($i = 0; $i < count($matrix1); $i++) {
            $row = array();
            if (!is_array($matrix1[$i])) $matrix1[$i] = array($matrix1[$i]);
            for ($j = 0; $j < count($matrix1[$i]); $j++) {
                if ($matrix1[$i][$j] == 0) {
                    $element = -$matrix2[$i][$j];
                } else {
                    $element = $matrix1[$i][$j] - $matrix2[$i][$j];
                }
                $row[] = $element;
            }
            $result[] = $row;
        }
        return $result;
    }
    public static function sum($matrix1, $matrix2) {
        $result = array();
        for ($i = 0; $i < count($matrix1); $i++) {
            $row = array();
            if (!is_array($matrix1[$i])) $matrix1[$i] = array($matrix1[$i]);
            for ($j = 0; $j < count($matrix1[$i]); $j++) {
                $row[] = $matrix1[$i][$j] + $matrix2[$i][$j];
            }
            $result[] = $row;
        }
        return $result;
    }
    public static function reverse($matrix) {
        $result = array();
        foreach ($matrix as $row) {
            $reverse_row = array();
            foreach ($row as $element) {
                if (is_array($element)) continue;
                $reverse_element = -$element;
                $reverse_row[] = $reverse_element;
            }
            $result[] = $reverse_row;
        }
        return $result;
    }
    public static function subtract_constant($const, $matrix) {
        $result = array();
        for ($i = 0; $i < count($matrix); $i++) {
            if (is_array($matrix[$i])) {
                $element = self::subtract_constant($const, $matrix[$i]);
            }
            else if ($const == 0) {
                $element = -$matrix[$i];
            } else {
                $element = $const - $matrix[$i];
            }
            $result[] = $element;
        }
        return $result;
    }
    public static function add_constant($const, $matrix) {
        $result = array();
        foreach ($matrix as $row) {
            $new_row = array();
            foreach ($row as $element) {
                $new_element = $const + $element;
                $new_row[] = $new_element;
            }
            $result[] = $new_row;
        }
        return $result;
    }
    public static function divide_constant($const, $matrix) {
        $result = array();
        foreach ($matrix as $row) {
            $divide_row = array();
            foreach ($row as $element) {
                $divide_element = $const / $element;
                $divide_row[] = $divide_element;
            }
            $result[] = $divide_row;
        }

        return $result;
    }
    public static function transpose($matrix) {
        $result = array();
        $rows = count($matrix);
        $columns = count($matrix[0]);
        for ($i = 0; $i < $columns; $i++) {
            $row = array();
            for ($j = 0; $j < $rows; $j++) {
                $row[] = $matrix[$j][$i];
            }
            $result[] = $row;
        }
        return $result;
    }
    public static function exp($matrix) {
        $result = array();
        foreach ($matrix as $row) {
            $exp_row = array();
            foreach ($row as $element) {
                if (is_array($element)) continue;
                $exp_element = exp($element);
                $exp_row[] = $exp_element;
            }
            $result[] = $exp_row;
        }
        return $result;
    }
}
