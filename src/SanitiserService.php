<?php

namespace Devtoolboxuk\DataSanitiser;

class SanitiserService
{

    public function sanitise($data, $type = 'special_chars', $stringLength = null)
    {
        $data = strip_tags(trim($data));
        $data = $this->stringLength($data, $stringLength);

        $result = null;

        switch ($type) {
            case "email":
                $result = filter_var($data, FILTER_SANITIZE_EMAIL);
                break;

            case "encoded":
                $result = filter_var($data, FILTER_SANITIZE_ENCODED);
                break;

            case "number_float":
            case "float":
                $result = filter_var($data, FILTER_SANITIZE_NUMBER_FLOAT);
                break;

            case "number_int":
            case "int":
                $result = filter_var($data, FILTER_SANITIZE_NUMBER_INT);
                break;

            case "special_chars":
                $result = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
                break;

            case "full_special_chars":
                $result = filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                break;

            case "url":
                $result = filter_var($data, FILTER_SANITIZE_URL);
                break;

            case "string":
                $result = filter_var($data, FILTER_SANITIZE_STRING);
                break;
        }

        if (!$result) {
            throw new \InvalidArgumentException(sprintf("%s is not a valid input for type %s", $data, $type));
        }

        return $data;
    }

    private function stringLength($data, $stringLength = null)
    {
        if ($stringLength) {
            if (mb_strlen($data) > $stringLength) {
                $data = substr($data, 0, $stringLength);
            }
        }
        return $data;
    }

}