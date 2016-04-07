<?php namespace App\Services;

use Illuminate\Html\FormBuilder;

/**
 * Class Macros
 * @package App\Http
 */
class Macros extends FormBuilder {

    /**
     * @param $name
     * @param null $selected
     * @param array $options
     * @return string
     */
    public function selectAttr($name, $options = array(), $selected = null, $class = null)
    {

        $selectHtml = "<select name=\"{$name}\" class=\"{$class['class']}\">";
        foreach($options as $attrs){

            $selectHtml .= "<option value=\"{$attrs['value']}\"";

            $selectHtml .= !is_null($selected) && $selected == $attrs['value'] ? " selected " : "";

            foreach($attrs as $attr => $value){
                switch($attr){
                    case 'value':
                    case 'text':
                    break;
                    default:
                        $selectHtml .= "{$attr}=\"{$value}\" ";
                    break;
                }
            }

            $selectHtml .= ">{$attrs['text']}</option>";
        }
        $selectHtml .= "</select>";

        return $selectHtml;
    }
}