<?php

namespace Devtoolboxuk\DataSanitiser;

class SanitiserService
{
    public function sanitiseDisplay($data)
    {
        $data = $this->cleanString($data);
        $data = mb_convert_encoding($data, "utf-8", "HTML-ENTITIES");
        return htmlspecialchars_decode($data);
    }

    public function sanitiseForCSV($string, $delimiter = "|")
    {
        return trim(str_replace(array($delimiter, "\n", "\r", "\t"), " ", $string));
    }

    /**
     * @param $data
     * @return string
     */
    private function cleanString($data)
    {
        $data = implode("", explode("\\", $data));
        return strip_tags(trim(stripslashes($data)));
    }

    /**
     * @param $data
     * @param string $type
     * @param null $stringLength
     * @return mixed|null
     */
    public function sanitise($data, $type = 'special_chars', $stringLength = null)
    {
        $data = $this->cleanString($data);
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
                $result = filter_var($data, FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_NO_ENCODE_QUOTES);
                break;

            case "url":
                $result = filter_var($data, FILTER_SANITIZE_URL);
                break;

            case "string":
                $result = filter_var($data, FILTER_SANITIZE_STRING, FILTER_FLAG_NO_ENCODE_QUOTES);
                break;
        }


        return $result;
    }

    /**
     * @param $data
     * @param null $stringLength
     * @return bool|string
     */
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