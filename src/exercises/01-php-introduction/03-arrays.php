<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arrays Exercises - PHP Introduction</title>
    <link rel="stylesheet" href="/exercises/css/style.css">
</head>
<body>
    <div class="back-link">
        <a href="index.php">&larr; Back to PHP Introduction</a>
        <a href="/examples/01-php-introduction/03-arrays.php">View Example &rarr;</a>
    </div>

    <h1>Arrays Exercises</h1>

    <!-- Exercise 1 -->
    <h2>Exercise 1: Favorite Movies</h2>
    <p>
        <strong>Task:</strong> 
        Create an indexed array with 5 of your favorite movies. Use a for 
        loop to display each movie with its position (e.g., "Movie 1: 
        The Matrix").
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $movies = ['star wars', 'jurrasic park', 'avengers', 'toy story', 'cars'];
        echo "<ul>";
        for ($i = 0; $i < count($movies); $i++) {
            echo "<li>Movie $i: $movies[$i]</li>";
        }
        echo "</ul>";
        ?>
    </div>

    <!-- Exercise 2 -->
    <h2>Exercise 2: Student Record</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array for a student with keys: name, studentId, 
        course, and grade. Display this information in a formatted sentence.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $student = [
            "name" => "Michael Johnson",
            "studentId" => "0123456789",
            "course" => "computers",
            "grade" => "F"
        ];

        $text = "{$student['name']} with student ID number {$student['studentId']} in the {$student['course']} course has the grade {$student['grade']}";
        print("<p>$text</p>")
        ?>
    </div>

    <!-- Exercise 3 -->
    <h2>Exercise 3: Country Capitals</h2>
    <p>
        <strong>Task:</strong> 
        Create an associative array with at least 5 countries as keys and their 
        capitals as values. Use foreach to display each country and capital 
        in the format "The capital of [country] is [capital]."
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $capitals = [
            "Ireland" => "Dublin",
            "England" => "London",
            "Scotland" => "Glasgow",
            "Wales" => "Cardiff",
            "America" => "Washington DC"
        ];
        echo "<ul>";
        foreach ($capitals as $country => $capital) {
            echo "<li>$capital is the capital of $country</li>";
        }
        echo "</ul>"
        ?>
    </div>

    <!-- Exercise 4 -->
    <h2>Exercise 4: Menu Categories</h2>
    <p>
        <strong>Task:</strong> 
        Create a nested array representing a restaurant menu with at least 
        2 categories (e.g., "Starters", "Main Course"). Each category should 
        have at least 3 items with prices. Display the menu in an organized 
        format.
    </p>

    <p class="output-label">Output:</p>
    <div class="output">
        <?php
        // TODO: Write your solution here
        $menu = [
            'Starters' => [
                'Soup of the day' => "7.50",
                'BBQ Ribs' => "8.50",
                'Salad' => "7.00" 
            ],
            'Main course' => [
                'Pizza' => "12.50",
                'Chicken Pasta' => "13.00",
                'Beef Burger' => "13.50"
            ],
            'Dessert' => [
                'Brownie' => "9.00",
                'Ice Cream' => "6.00",
                'Apple Pie' => "8.00"
            ]
        ];
        foreach ($menu as $category => $item) {
            echo "<p>" . ucfirst($category) . "</p>";
            echo "<ul>";
            foreach ($item as $prices => $price) {
                echo "<li>$prices\t €$price</li>";
            }
            echo "</ul>";
        }
        ?>
    </div>

</body>
</html>
