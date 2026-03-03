import Car from './classes/Car.js';

let bmw = new Car('BMW', '5 Series', 2026, 'Green', ['HUD', 'Keyless']);
let bmw2 = new Car('BMW', '3 Series', 2025, 'Red', {});
let audi = new Car('Audi', 'A6', 2024, 'Yellow');

let myCars = [bmw, bmw2, audi];

myCars.forEach((car) => {
    console.log(`${car}`);
    // console.log(car.year);
});


