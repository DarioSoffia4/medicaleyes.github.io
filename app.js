let temp;
var hidden = true;

$("form").submit(function (e) {
  let containerPass = document.getElementById("passwordSignup");
  let containerMail = document.getElementById("input-signup-login");
  let containerNome = document.getElementById("nameSignup");

  let Password = containerPass.value;
  let Mail = containerMail.value;
  let Name = containerNome.value;

  const regularExpression = /^(?=.*[0-9])(?=.*[!@#$%^&*_])[a-zA-Z0-9!@#$%^&*_]{8,}$/;
  const email_check = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
  const name_check = /^[a-zA-Z0-9_]{3,10}$/;

  let result =true;
  if(!(name_check.test(Name))){
    console.log("nome"); 
    result=false;
    containerNome.style.border = "solid red 1px";
    containerNome.style.color = "red";
  }
  if(!(email_check.test(Mail))){
    console.log("mail");
    result=false;
    containerMail.style.border = "solid red 1px";
    containerMail.style.color = "red";
    
  }

  if(!(regularExpression.test(Password))) {
    result=false
    containerPass.style.border = "solid red 1px";
    containerPass.style.color = "red";
  }

  return result;
});

document.getElementById("passwordSignup").addEventListener("focus",(e) => changeBack(e));
document.getElementById("input-signup-login").addEventListener("focus",(e) => changeBack(e));
document.getElementById("nameSignup").addEventListener("focus",(e) => changeBack(e));

function changeBack(e)
{
  let containerPass = document.getElementById("passwordSignup");
  let containerMail = document.getElementById("input-signup-login");
  let containerNome = document.getElementById("nameSignup");
  containerMail.style.border = "1px solid #dedede";
  containerMail.style.color = "black";
  containerPass.style.border = "1px solid #dedede";
  containerPass.style.color = "black";
  containerNome.style.border = "1px solid #dedede";
  containerNome.style.color = "black";

}

function removeDiv() {
  var container = (document.getElementById("user-space-limiter").style.display =
    "none");
}
function dropmenu() {
  var yourUl = document.getElementById("pop-up-profile");
  yourUl.style.display = yourUl.style.display === "none" ? "" : "none";
  if (yourUl.style.display === "none") hidden = true;
  else hidden = false;
  document.addEventListener('keyup', function(event) {
    if (event.key === "Escape" || event.keyCode === 27) {
      yourUl.style.display = "none";
      back.style.opacity = 0;
    }
  });  
}
function deletepopup(avg) {
  var yourU = document.getElementById("popup-delete");
  var back = document.getElementById("overlay");
  back.style.opacity = back.style.opacity == 0.7 ? 0 : 0.7;
  yourU.style.display = yourU.style.display === "none" ? "" : "none";
  document.addEventListener('keyup', function(event) {
    if (event.key === "Escape" || event.keyCode === 27) {
      yourU.style.display = "none";
      back.style.opacity = 0;
    }
  });
  temp = avg.href;
  event.preventDefault();
}
function addpopup() {
  var yourU = document.getElementById("popup-addproject");
  var back = document.getElementById("overlay");
  back.style.opacity = back.style.opacity == 0.7 ? 0 : 0.7;
  yourU.style.display = yourU.style.display === "none" ? "" : "none";
  document.addEventListener('keyup', function(event) {
    if (event.key === "Escape" || event.keyCode === 27) {
      yourU.style.display = "none";
      back.style.opacity = 0;
    }
  });  
}
function removePopup(){
  console.log("hello");
  var yourU1 = document.getElementById("popup-addproject");
  var yourU2 = document.getElementById("popup-delete");
  var back = document.getElementById("overlay");

  if(yourU1.style.display===""){
    yourU1.style.display="none";
  }else if(yourU2.style.display===""){
    yourU2.style.display="none";
  }
}

function getImg(evt){
  var files = evt.target.files;
  var file = files[0];
  document.getElementById("name-upload-image").innerHTML = file.name;
}

function takeNameFile(){
  console.log("ciao");
  var filename =  $('#name-upload-image').val().split('\\').pop();
  document.getElementById("name-upload-image").innerHTML = filename;
}


/*
$("#image-upload").change(function(){
  console.log("ciao");
  var filename = $('#name-upload-image').val().split('\\').pop();
  document.getElementById("name-upload-image").innerHTML = filename;
});*/


function deleteRecord(){
  window.location.href = temp;
}
