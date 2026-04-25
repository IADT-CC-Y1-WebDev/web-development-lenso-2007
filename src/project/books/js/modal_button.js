

let cardContainer = document.querySelector("#book_cards");

cardContainer.addEventListener('click', (e) => {
  console.log(e.target);

  let el = e.target;

  console.log(el.className === "delete-btn");

  if(el.className === "delete-btn"){
    document.getElementById(el.dataset.modal).style.display = "flex";
  }
  else if(el.className === "cancelbtn" || el.className === "modal"){
    document.getElementById(el.dataset.modal).style.display = "none";
  }
});


// let deleteButtons = document.querySelectorAll('.delete-btn');

// deleteButtons.forEach((btn) => {
//   btn.addEventListener('click', () => {
//     console.log(btn.dataset.modal);
//     document.getElementById(btn.dataset.modal).style.display = "block";
//     document.getElementById(btn.dataset.modal).dataset.open = "true";
//   });
// });



// let modals = document.querySelectorAll('.modal');

// modals.forEach((modal) => {
//   modal.addEventListener('click', (e) => {
//     console.log(e.target.dataset.open);
//     if(e.target.dataset.open){
//       console.log("clicked outside");
//       document.getElementById(modal.id).style.display = "none";
//     }
//     else if(e.target.dataset.modal){
//       console.log("cancel");
//       document.getElementById(modal.id).style.display = "none";
//     }
//   });
// });

