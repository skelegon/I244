function test(){
  if (document.getElementById("images") != null) {
    var pildid = document.getElementById("images");
    var pildid_array = pildid.getElementsByTagName("a");
    var sulge = pildid.getElementsByTagName("sulge");

    for(var i = 0; i < pildid_array.length; i++){
        pildid_array[i].setAttribute("onclick", "showDetails(this); return false");
    }
    document.getElementById('sulge').addEventListener('click', hideDetails);
  }
}

function showDetails(el) {
  if (document.getElementById("hoidja") != null){
     /*
    document.getElementById("suurpilt").src = el.parentNode.getAttribute("href");
    document.getElementById("suurpilt").onload = "suurus(this)";
    document.getElementById("inf").innerHTML = el.getAttribute("alt");
    */
    $.get(el.href, "html", function(data){
        alert(data);
	document.getElementById('sisu').innerHTML=data;
    });

    document.getElementById("hoidja").style = "display:initial";
  }
  return false;
}

function suurus(el){
  el.removeAttribute("height"); // eemaldab suuruse
  el.removeAttribute("width");
  if (el.width>window.innerWidth || el.height>window.innerHeight){  // ainult liiga suure pildi korral
    if (window.innerWidth >= window.innerHeight){ // lai aken
      el.height=window.innerHeight*0.9; // 90% kõrgune
      if (el.width>window.innerWidth){ // kas element läheb ikka üle piiri?
        el.removeAttribute("height");
        el.width=window.innerWidth*0.9;
      }
    } else { // kitsas aken
      el.width=window.innerWidth*0.9;   // 90% laiune
      if (el.height>window.innerHeight){ // kas element läheb ikka üle piiri?
        el.removeAttribute("width");
        el.height=window.innerHeight*0.9;
      }
    }
  }
}

function hideDetails() {
  document.getElementById("hoidja").style = "display:none";
}

window.onresize=function() {
	suurpilt=document.getElementById("suurpilt");
	suurus(suurpilt);
}
