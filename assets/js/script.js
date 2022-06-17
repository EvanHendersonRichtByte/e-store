const url = window.location.href;
$(document).ready(() => {
  $(".admin nav a").each((i, e) => {
    e.getAttribute("href") === url && $(e).addClass("active");
  });
});

$('.client-dashboard-navbar').fadeIn()

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

// Reset Payment Form
resetPaymentSelection();

$("#payment-select").on("change", (e) => {
  let selectVal = e.target.value;
  handlePaymentSelection(selectVal);
});

function resetPaymentSelection() {
  $("#payment-form > *").each((i, e) => {
    $(e).css("display", "none");
    $("#payment-form img").css("display", "none");
    $("#payment-form-e-pay .form-group input").each((i, e) => {
      $(e).removeAttr("required");
    });
  });
}

function editInputDewe(jml,stokbrg) {
  if (jml<=stokbrg && jml>0) {
    document.getElementById("editInput").value = jml;
    document.getElementById("formAdd").submit();
    location.reload;
  } else {
    alert('Pastikan jumlah barang yang ingin dibeli telah benar!');
    document.getElementById('editInputField').value = document.getElementById("editInput").value;
    location.reload;
  }
}

const handlePaymentSelection = (selectVal) => {
  if (selectVal === "COD") {
    resetPaymentSelection();
  } else if (selectVal === "E-Pay") {
    resetPaymentSelection();
    $("#payment-form-e-pay").css("display", "block");
    $("#payment-form-e-pay .form-group input").each((i, e) => {
      $(e).attr("required", true);
    });
  } else if (selectVal === "QR") {
    resetPaymentSelection();
    $("#payment-form-qr").css("display", "block");
    $("#payment-form-qr img").css("display", "block");
  }
};
