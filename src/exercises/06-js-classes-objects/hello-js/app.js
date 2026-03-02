console.log("Hello World!");

// function timesTwo(inputNumber) {
//     return inputNumber * 2;
// }

const timesTwo = (inputNumber) => {
    return inputNumber * 2;
};

console.log(timesTwo(10) + 5);

let myName = "Lennon";

console.log(myName);

function greeting() {
    console.log("Hi");
};

// setTimeout(greeting, 5000);


let user = {
    firstName: "John",
    lastName: "Jones",
    age: 32,
    hobbies: ["Gym", "Movies"],
    friends: [
        {
            firstName: "Lennon",
            lastName: "Graham",
            age: 18,
        },
        {
            firstName: "Walter",
            lastName: "White",
            age: 50,
        }
    ]
};

console.log(user);

let donuts = ["chocolate", "jam", "custard"];

donuts.forEach((donut, i) => {
    // console.log(i + 1 + " " + donut);
    console.log( `Option ${i+1}: ${donut}` );
});