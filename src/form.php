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
    $error = $errors[$key] ?? '.';
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
 * @param array $errors
 * @return string
 */
function select(string $key, array $options, $errors = []): string {    
    $generateOptions = "";
    foreach ($options['database'] as $option) {
        $v = $option[$options['value']];
        $selected = (isset($options['update']) && $options['update'] == $v) ||
        (getData($key, $options['data']) == $v)? 'selected' : '';
        $generateOptions .= "<option 
            value=\"{$v}\" $selected>
        {$option[$options['view']]}</option>";
    }
    $error = $errors[$key]  ?? '.';
    $label = !is_null($options['label']) ? "
    <option value=\"\">{$options['label']}</option>
    ":  '';

    return " <select class=\"{$options['class']}\" name=\"{$key}\" id=\"$key\">
        $label
        {$generateOptions}
    </select>
    <div class=\"error-field\"> {$error}</div>";
} 



function textarea(
    string $key,
    array $data, 
    array $errors = [], 
    ?string $updateValue = null): string {
    $value = getData($key, $data, $updateValue);

    if (empty($errors)) {
        return "<textarea name=\"$key\" id=\"$key\" class=\"input-form\">$value</textarea>";
    }
    $error = $errors[$key] ?? '';
    return "
    <textarea name=\"$key\" id=\"$key\" class=\"input-form\">$value</textarea>
    <div class=\"error-field\"> 
        {$error}
    </div>
    ";
}



function inputFile(
    $key, 
    array $attributes,
    array $errors = []): string {
    $string = arrayToString($attributes);

    if (empty($errors)) {
        return "<input name=\"$key\" id=\"$key\" {$string}>";
    }

    $error = $errors[$key] ?? '';
    return "
    <input name=\"$key\" id=\"$key\" {$string}>;
    <div class=\"error-field\">
        {$error}
    </div>
    ";
}