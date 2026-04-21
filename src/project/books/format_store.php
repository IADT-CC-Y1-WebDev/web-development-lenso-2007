<?php
require_once './php/lib/config.php';
require_once './php/lib/session.php';
require_once './php/lib/forms.php';
require_once './php/lib/utils.php';

    $data = [];
    $errors = [];
startSession();

try {


    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        throw new Exception('Invalid request method.');
    }

    $data = [
        'name' => $_POST['name'] ?? null,
    ];

      

    $rules = [
        'name' => 'required|notempty|min:3|max:255',
    ];

    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    $format = new Format();
    $format->name = $data['name'];


    $format->save();

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Format stored successfully.');

    redirect('format_list.php?id=' . $format->id);
}
catch (Exception $e) {

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    redirect('format_create.php');
}
