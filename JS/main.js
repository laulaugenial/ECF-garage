// TOGGLE MENU
var navLinks = document.getElementById("navLinks");

function showMenu() {
  navLinks.style.right = "0";
}
function hideMenu(){
  navLinks.style.right = "-200px";
}


// MODAL
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}



// Sélectionnez tous les boutons "Afficher plus"
var showMoreButtons = document.querySelectorAll('.show-more-btn');

// Ajoutez un gestionnaire d'événements à chaque bouton "Afficher plus"
showMoreButtons.forEach(function(button) {
  button.addEventListener('click', function() {
      var product = this.parentNode;
      var additionalInfo = product.querySelector('.additional-info');
      additionalInfo.classList.toggle('show'); // Ajoute ou supprime la classe "show" pour afficher ou masquer les informations supplémentaires
      if (additionalInfo.classList.contains('show')) {
          this.textContent = 'Afficher moins';
      } else {
          this.textContent = 'Afficher plus';
      }
  });
});




