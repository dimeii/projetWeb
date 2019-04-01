/**
 * Fonction de récupération des paramètres GET de la page
 * @return Array Tableau associatif contenant les paramètres GET
 */
function extractUrlParams() {
  var t = location.search.substring(1).split("&");
  var f = [];
  for (var i = 0; i < t.length; i++) {
    var x = t[i].split("=");
    f[x[0]] = x[1];
  }
  return f;
}

$(document).ready(function() {
  console.log("test");

  $("img").click(() => {
    // var espaceComm = document.getElementsByClassName("comm");
    // var newComment = 'new comment';
    // console.log(espaceComm);
    // espaceComm.appendChild(newComment);
    
  });
  $("#submit").click(() => {
    console.log("submmited");
    var value_comment = document.getElementById("commentaireArea").value;
    var idImg = extractUrlParams().img;
    console.log(extractUrlParams().img);
    $.ajax({
      url: "post_comment.php",
      method: "POST",
      dataType: "json",
      data: {
        idImg: idImg,
        valueComment: value_comment
        //  type: 'img',
      },
      success: function(response) {
        //  $('#idDeTonContainer').text(response.likes);
        // console.log(response);
        if (response.resultPost) {
          alert("Votre commentaire a bien posté :) , cliquez sur OK. ");

          setTimeout(()=>{
            window.location.reload()
          }, 2000);

        } else {
          alert("Une erreur est survenu... ");
        }
      }
    });
  });
});
