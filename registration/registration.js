console.log("Ce programme JS vient d'être chargé");
var champs = document.getElementsByTagName("input");

var regleMetier = function() {};

var mdpSimilaires = function() {
  var sameMdp = false;
  var champMdp = document.getElementById("password").value;
  var champMdpConf = document.getElementById("passwordControl").value;

  console.log("champMdp = " + champMdp);
  console.log("champMdpConf = " + champMdpConf);
  console.log(champMdp === champMdpConf);
  return champMdp === champMdpConf;
};

document
  .getElementById("passwordControl")
  .addEventListener("input", function() {
    mdpSimilaires();
  });

document.getElementById("password").addEventListener("input", function() {
  mdpSimilaires();
});

var parcoursChamps = function() {
  // renvoie false si tous les champs sont remplis
  let champsVides = true;

  for (var i of champs) {
    champsVides = i.value === "";
    // console.log(i.value === '');
    if (champsVides) break;
  }
  return champsVides;
};

var putListener = function() {
  // si la fonction parcoursChamps renvoie false on met le bouton submit en vert
  let submitButton = document.getElementById("submit");

  for (var i of champs) {
    i.addEventListener("input", function() {
      // console.log('changement');
      if (!parcoursChamps()) {
        // console.log('Tous les champs sont remplis');
        if (mdpSimilaires()) {
          submitButton.style.backgroundColor = "green";
          submitButton.style.borderColor = "green";
          submitButton.disabled = false;
		}else{
			alert('Veuillez entrer des mots de passes similaires');
		}
      } else {
        submitButton.style.backgroundColor = "grey";
        submitButton.style.borderColor = "grey";
        submitButton.disabled = !submitButton.disabled;
      }
    });
  }
};

putListener();
