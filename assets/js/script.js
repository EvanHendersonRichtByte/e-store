const url = window.location.href;
$(document).ready(() => {
  $(".admin nav a").each((i, e) => {
    e.getAttribute("href") === url && $(e).addClass("active");
  });
});

$("#changeImage").bind("change", () => {});

Filevalidation = (target) => {
  // alert($("#changeImage")[0].files[0].fileSize);
  // const fi = document.getElementById("changeImage");
  // Check if any file is selected.
  if (target.files.length > 0) {
    const fsize = target.files[0].size;
    const file = Math.round(fsize / 1024);
    // The size of the file.
    if (file >= 1024) {
      alert("File too Big, please select a file less than 1mb");
    } else {
      document.getElementById("size").innerHTML = "<b>" + file + "</b> KB";
    }
  }
};
