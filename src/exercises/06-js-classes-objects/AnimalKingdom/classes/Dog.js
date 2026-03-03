import Canine from "./Canine.js"

class Dog extends Canine{

    constructor(_name, _age){
        super(_name, _age);
    }

    makeNoise(){
        console.log("Barking: bark bark bark");
    }


}

export default Dog;