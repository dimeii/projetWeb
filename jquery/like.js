$(document).ready(function() {
    console.log("test");
  
    $(".toLike").click(() => {
      console.log("like");
      // console.log($(this).attr('id'));
      // console.log((event.target).id);
      var img = event.target;
      // var nbLike = img.childNodes[2].data;
      var idImg = img.id;
      $.ajax({
        url: "like_photo.php",
        method: "POST",
        dataType: "json",
        data: {
          idImg: idImg
        },
        success: function(response) {
          if (response.connecte) {
            console.log(response);
            // console.log(img.childNodes);
            if (parseInt(response.everLike) === 1) {
              img.childNodes[1].className = "fa fa-heart-o";
            } else {
              img.childNodes[1].className = "fa fa-heart";
            }
  
            img.childNodes[2].data = " " + response.nbLike + " likes";
          }else{
            alert('Pour aimer une photo veuiller vous connecter.');
          }
        }
      });
    });
  });
  