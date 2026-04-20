<?php
require_once 'php/lib/config.php';
require_once 'php/lib/session.php';
require_once 'php/lib/forms.php';
require_once 'php/lib/utils.php';

startSession();

try {
    // Initialize form data array
    $data = [];
    // Initialize errors array
    $errors = [];
    
    // Check if request is GET
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
        throw new Exception('Invalid request method.');
    }

    // Get form data
    $data = [
        'id' => $_GET['id'] ?? null
    ];

    // Define validation rules
    $rules = [
        'id' => 'required|integer'
    ];

    // Validate all data (including file)
    $validator = new Validator($data, $rules);

    if ($validator->fails()) {
        // Get first error for each field
        foreach ($validator->errors() as $field => $fieldErrors) {
            $errors[$field] = $fieldErrors[0];
        }

        throw new Exception('Validation failed.');
    }

    // Find existing book
    $publisher = Publisher::findById($data['id']);
    if (!$publisher) {
        throw new Exception('Publisher not found.');
    }

    // Delete the book
    $publisher->delete();

    // Clear any old form data
    clearFormData();
    // Clear any old errors
    clearFormErrors();

    // Set success flash message
    setFlashMessage('success', 'Publisher deleted successfully.');

    // Redirect to book details page
    redirect('publisher_list.php');
}
catch (Exception $e) {
    // Set error flash message
    setFlashMessage('error', 'Error: ' . $e->getMessage());

    // Store form data and errors in session
    setFormData($data);
    setFormErrors($errors);

    // Redirect back to view page if there is an ID; otherwise, go to index page
    if (isset($data['id']) && $data['id']) {
        redirect('publisher_list.php?id=' . $data['id']);
    }
    else {
        redirect('publisher_list.php');
    }
}
