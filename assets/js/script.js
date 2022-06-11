const url = window.location.href;
$(document).ready(() => {
  $(".admin nav a").each((i, e) => {
    e.getAttribute("href") === url && $(e).addClass("active");
  });
});
