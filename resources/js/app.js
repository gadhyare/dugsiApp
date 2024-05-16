import './bootstrap';
$.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
  },
});


// function multiSelectCheckBox() {
//   const chkall = document.getElementById("chkall");
//   const selects = document.getElementsByClassName("chkitem");
//   chkall.addEventListener("change", function () {
//     if (chkall.checked == true) {
//       for (let i = 0; i < selects.length; i++) {
//         selects[i].checked = true;
//       }
//     } else {
//       for (let i = 0; i < selects.length; i++) {
//         selects[i].checked = false;
//       }
//     }
//   });
// }



// multiSelectCheckBox();
