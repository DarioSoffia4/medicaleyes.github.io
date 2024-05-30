
$(document).ready(function () {
    $("#word_count").on("keyup", function () {
      var words = 0;
  
      if (this.value.match(/\S+/g) != null) {
        words = this.value.match(/\S+/g).length;
      }
      if (words > 200) {
        var trimmed = $(this).val().split(/\s+/, 200).join(" ");
        $(this).val(trimmed + " ");
      } else {
        $("#display_count").text(words);
        $("#word_value").text(200 - words);
      }
    });
  });

  document.addEventListener("DOMContentLoaded", function () {
    var flipLinks = document.querySelectorAll(".rotate-link");
    flipLinks.forEach(function (link) {
      link.addEventListener("click", function () {
        var flipCardInner = link.closest(".flip-card");
        var flipCardInnerBack = link.closest(".flip-card-back");
        flipCardInner.classList.toggle("flip");
        flipCardInnerBack.classList.toggle("flip");
      });
    });
  });