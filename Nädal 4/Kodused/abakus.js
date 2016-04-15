window.onload = function() {
  var b = document.getElementsByClassName('bead')
  for (var i = 0; i < b.length; i++) {
    b[i].addEventListener('click', changeClass);
  }
}

function changeClass (){
    if (this.style.float === 'left'){
        this.style.float = 'right';
    } else {
        this.style.float = 'left';
    }
}
