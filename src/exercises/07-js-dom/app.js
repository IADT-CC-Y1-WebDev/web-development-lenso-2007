console.log("hello world")


let myButton = document.getElementById("myBtn");
let userInput = document.getElementById("title");


function addParagraph(){
    const p = document.createElement('p');
    p.innerHTML = userInput.value;
    document.body.appendChild(p);
};

myButton.addEventListener('click', addParagraph);
userInput.addEventListener('keyup', function(e){
    if(e.key === 'Enter'){
        addParagraph();
    }
});