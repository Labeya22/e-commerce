<?php

/**
 * convertit un tableau en string
 *
 * @param array $array
 * @return string
 */
function arrayToString(array $array): string
{
    $string = [];
    foreach ($array as $key => $value) {
        $string[] = "$key=\"$value\"";
    }
    return implode(' ', $string);
}

/**
 * récupèrer les valeursdu formulaire
 *
 * @param string $key
 * @param array $data
 * @param string|null $update
 * @return string|null
 */
function getData(string $key, array $data, ?string $update = null): ?string {
    if (!isset($data[$key]) && is_null($update)) return null;
    if (!isset($data[$key]) && !is_null($update)) return $update;
    else return $data[$key];
}

/**
 * input (text, number, email, etc.)
 *
 * @param string $key
 * @param array $attributes
 * @param [type] $data
 * @return string
 */
function input(string $key, array $attributes, $data): string {
    $string = arrayToString($attributes);
    $value = $data[$key] ?? null;
   return "<input name=\"$key\" id=\"$key\" value=\"$value\" {$string}>";
}

function inputField(
    string $key, 
    array $attributes, 
    array $data, 
    array $errors = [], 
    ?string $updateValue = null): string {
    $string = arrayToString($attributes);
    $value = getData($key, $data, $updateValue);

    if (empty($errors)) {
        return "<input name=\"$key\" id=\"$key\" value=\"$value\" {$string}>";
    }

    $error = $errors[$key] ?? '';
    return "
    <input name=\"$key\" id=\"$key\" value=\"$value\" {$string}>
    <div class=\"error-field\">
        {$error}
    </div>
    ";

}

/**
 * checkbox
 *
 * @param string $key
 * @param string $checked
 * @param array $data
 * @return string
 */
function checkbox(string $key, string $checked,  array $data): string {
    $value = $data[$key] ?? null;
    if ($value === $checked) {
        return "<input type=\"checkbox\" name=\"$key\" id=\"$key\" value=\"$checked\" checked=\"checked\">";
    }
    return "<input type=\"checkbox\" name=\"$key\" id=\"$key\" value=\"$checked\">";
}

/**
 * combobox
 *
 * @param string $key
 * @param array $options
 * @return string
 */
function select(string $key, array $options): string {
    [
        'database' => $database,
        'class' => $class,
        'value' => $optionValue,
        'view' => $optionView,
        'data' => $data,
        'label' => $label
    ] = $options;
    
    $generateOptions = "";

    foreach ($database as $option) {
        $v = $option[$optionValue];
        $selected = getData($key, $data) === $v ? 'selected' : '';
        $generateOptions .= "<option 
            value=\"{$v}\" $selected>
        {$option[$optionView]}</option>";
    }

    return "
    <select class=\"{$class}\" name=\"{$key}\" id=\"$key\">
    <option value=\"\">$label</option>
    {$generateOptions}
    </select>
    ";
} 
