import Cat from './classes/Cat.js';
import Dog from './classes/Dog.js';
import Lion from './classes/Lion.js';
import Wolf  from './classes/Wolf.js';

let cat1 = new Cat("Tom", 2);
let dog1 = new Dog("Mike", 4);
let lion1 = new Lion("John", 6);
let wolf1 = new Wolf("Walt", 3);

let animals = [cat1, dog1, wolf1, lion1]

animals.forEach((animal) => {
    animal.makeNoise();
    animal.roam();
    animal.sleep();

    console.log("=============");
});

console.log(dog1 instanceof Dog);