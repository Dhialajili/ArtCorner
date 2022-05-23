/* ===================================
--------------------------------------
  SolMusic HTML Template
  Version: 1.0
--------------------------------------
======================================*/

"use strict";

$(window).on("load", function () {
  /*------------------
		Preloder
	--------------------*/
  $(".loader").fadeOut();
  $("#preloder").delay(400).fadeOut("slow");

  if ($(".playlist-area").length > 0) {
    var containerEl = document.querySelector(".playlist-area");
    var mixer = mixitup(containerEl);
  }
});
