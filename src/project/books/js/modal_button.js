var modal = document.getElementById('modal-<?= $book->id ?>');

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}