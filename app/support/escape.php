<?php

function e($value)
{
    if (is_array($value) || is_object($value)) {
        foreach ($value as $k => $v) {
            $value[$k] = $this->e($v);
        }
        return $value;
    }
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
}