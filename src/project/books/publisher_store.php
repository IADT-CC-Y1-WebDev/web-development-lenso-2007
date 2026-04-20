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

    $publisher = new Publisher();
    $publisher->name = $data['name'];


    $publisher->save();

    clearFormData();
    clearFormErrors();

    setFlashMessage('success', 'Book stored successfully.');

    redirect('publisher_list.php?id=' . $publisher->id);
}
catch (Exception $e) {

    setFlashMessage('error', 'Error: ' . $e->getMessage());

    setFormData($data);
    setFormErrors($errors);

    redirect('publisher_create.php');
}
