function successA() {
  Swal({
    title: "Good job!",
    text: "Your account has been created!",
    icon: "Success",
    button: "Continue",
  });
}

function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signInBox.classList.toggle("d-none");
  signUpBox.classList.toggle("d-none");
}
function test() {
  alert("hi");
}
function signUp() {
  successA();
  //   var n = document.getElementById("name");
  //   var cpw = document.getElementById("cpw");
  //   var e = document.getElementById("email");
  //   var pw = document.getElementById("password");
  //   var m = document.getElementById("mobile");
  //   var g = document.getElementById("gender");

  //   if (n == empty) {
  //   }

  //   var form = new FormData();
  //   form.append("n", n.value);
  //   form.append("cpw", cpw.value);
  //   form.append("e", e.value);
  //   form.append("pw", pw.value);
  //   form.append("m", m.value);
  //   form.append("g", g.value);

  //   var r = new XMLHttpRequest();

  //   r.onreadystatechange = function () {
  //     if (r.readyState == 4) {
  //       var text = r.responseText;
  //       if (text == "Success") {
  //         n.value = "";
  //         cpw.value = "";
  //         e.value = "";
  //         pw.value = "";
  //         m.value = "";

  //         document.getElementById("msg").innerHTML = "";
  //         changeView();
  //       } else {
  //         document.getElementById("msg").innerHTML = text;
  //       }
  //     }
  //   };
  //   r.open("POST", "signUpProcess.php", true);
  //   r.send(form);
}

function signIn() {
  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberMe");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("rm", rememberme.checked);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Success") {
        email.value = "";
        password.value = "";
        rememberme.checked = "";
        document.getElementById("msg2").innerHTML = "";
        window.location = "home.php";
      } else {
        document.getElementById("msg2").innerHTML = t;
      }
    }
  };
  r.open("POST", "signInProcess.php", true);
  r.send(form);
}

// var bm = new bootstrap.Modal(m);

// function forgotPassword() {
//     var email = document.getElementById("email2");

//     var r = new XMLHttpRequest();

//     r.onreadystatechange = function() {
//         if (r.readyState == 4) {
//             var t = r.responseText;
//             if (t == "Success") {
//                 alert("Verification code has sent to your email. Please check inbox.");
//                 var m = document.getElementById("forgotPasswordModel");
//                 bm = new bootstrap.Modal(m);
//                 bm.show();
//             } else {
//                 alert(t);
//             }
//         }
//     }
//     r.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
//     r.send();
// }

function showpassword1() {
  var np = document.getElementById("np");
  var npb = document.getElementById("npb");

  if (np.type == "password") {
    np.type = "text";
    npb.innerHTML = "<i class='bi bi-eye-fill'></i>";
  } else {
    np.type = "password";
    npb.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
  }
}

function showpassword2() {
  var rnp = document.getElementById("rnp");
  var rnpb = document.getElementById("rnpb");

  if (rnp.type == "password") {
    rnp.type = "text";
    rnpb.innerHTML = "<i class='bi bi-eye-fill'></i>";
  } else {
    rnp.type = "password";
    rnpb.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
  }
}

function resetpassword() {
  var e = document.getElementById("email2");
  var np = document.getElementById("np");
  var rnp = document.getElementById("rnp");
  var vc = document.getElementById("vc");

  var form = new FormData();
  form.append("e", e.value);
  form.append("np", np.value);
  form.append("rnp", rnp.value);
  form.append("vc", vc.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        alert("Password reset success");
        bm.hide();
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "resetPassword.php", true);
  r.send(form);
}

function signout() {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "home.php";
      }
    }
  };

  r.open("GET", "signoutprocess.php", true);
  r.send();
}

function viewpw() {
  var pwtxt = document.getElementById("pwtxt");
  var pwbtn = document.getElementById("pwbtn");

  if (pwtxt.type == "text") {
    pwtxt.type = "password";
    pwbtn.innerHTML = "<i class='bi bi-eye-fill'></i>";
  } else {
    pwtxt.type = "text";
    pwbtn.innerHTML = "<i class='bi bi-eye-slash-fill'></i>";
  }
}

function changeImage() {
  var view = document.getElementById("viewimg"); //image tag
  var file = document.getElementById("profileimg"); //file chooser

  file.onchange = function () {
    var file1 = this.files[0];
    var url1 = window.URL.createObjectURL(file1);
    view.src = url1;
  };
}

function update_profile() {
  var fname = document.getElementById("fn");
  var lname = document.getElementById("ln");
  var mobile = document.getElementById("mo");
  var line1 = document.getElementById("l1");
  var line2 = document.getElementById("l2");
  var province = document.getElementById("pr");
  var district = document.getElementById("dr");
  var city = document.getElementById("ci");
  var postal_code = document.getElementById("pc");
  var image = document.getElementById("profileimg");

  var form = new FormData();
  form.append("fn", fname.value);
  form.append("ln", lname.value);
  form.append("m", mobile.value);
  form.append("li1", line1.value);
  form.append("li2", line2.value);
  form.append("pr", province.value);
  form.append("dr", district.value);
  form.append("ci", city.value);
  form.append("pc", postal_code.value);

  if (image.files.length == 0) {
    var confirmAction = confirm(
      "Are you sure you don't want to update your profile picture?"
    );

    if (confirmAction) {
      alert("You have not selected any image");
    }
  } else {
    form.append("image", image.files[0]);
  }

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "Please Log In to your account first") {
        alert(t);
        window.location = "index.php";
      } else if (t == "Success") {
        window.location = "userProfile.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "updateProfileProcess.php", true);
  r.send(form);
}

function changeProductImage() {
  var image = document.getElementById("imageUploader");

  image.onchange = function () {
    var img_count = image.files.length;

    for (var x = 0; x < img_count; x++) {
      var file = this.files[x];
      var url = window.URL.createObjectURL(file);

      document.getElementById("preview" + x).src = url;
    }
  };
}

function addProduct() {
  //addProductProcess

  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");

  var condition = 0;
  if (document.getElementById("bn").checked) {
    condition = 1;
  } else if (document.getElementById("us").checked) {
    condition = 2;
  }

  var color = 0;

  if (document.getElementById("clr1").checked) {
    color = 1;
  } else if (document.getElementById("clr2").checked) {
    color = 2;
  } else if (document.getElementById("clr3").checked) {
    color = 3;
  } else if (document.getElementById("clr4").checked) {
    color = 4;
  } else if (document.getElementById("clr5").checked) {
    color = 5;
  } else if (document.getElementById("clr6").checked) {
    color = 6;
  }

  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var description = document.getElementById("description");
  var image = document.getElementById("imageUploader");

  var form = new FormData();
  form.append("cat", category.value);
  form.append("bra", brand.value);
  form.append("mod", model.value);
  form.append("tit", title.value);
  form.append("con", condition);
  form.append("clr", color);
  form.append("qty", qty.value);
  form.append("cost", cost.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("des", description.value);
  form.append("img", image.files[0]);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      alert(t);
    }
  };

  r.open("POST", "addProductProcess.php", true);
  r.send(form);
}

function changeStatus(id) {
  // alert(id);

  var product_id = id;
  var seitch_btn = document.getElementById("flexSwitchCheckDefault" + id);
  var switch_lbl = document.getElementById("switch_lbl" + id);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "deactivated") {
        alert("Product has been Deactivated");
        window.location = "myProducts.php";
      } else if (t == "activated") {
        alert("Product has been Activated");
        window.location = "myProducts.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "statusChangeProcess.php?id=" + product_id, true);
  r.send();
}

function sortFunction() {
  var search = document.getElementById("s");
  var time;

  if (document.getElementById("n").checked) {
    time = "1";
  } else if (document.getElementById("o").checked) {
    time = "2";
  }

  var qty;

  if (document.getElementById("l").checked) {
    qty = "1";
  } else if (document.getElementById("h").checked) {
    qty = "2";
  }

  var condition;

  if (document.getElementById("b").checked) {
    condition = "1";
  } else if (document.getElementById("u").checked) {
    condition = "2";
  }

  var f = new FormData();
  f.append("s", search.value);
  f.append("t", time);
  f.append("q", qty);
  f.append("c", condition);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("sort").innerHTML = t;
    }
  };

  r.open("POST", "sortProcess.php", true);
  r.send(f);

  // alert(search);
  // alert(time);
  // alert(qty);
  // alert(condition);
}

function clearSort() {
  window.location = "myProducts.php";
}

function sendId(id) {
  // alert(id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "updateProduct.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "sendProductIdProcess.php?id=" + id, true);
  r.send();
}

function updateProduct() {
  var title = document.getElementById("ti");
  var qty = document.getElementById("qty");
  var delivery_within_colombo = document.getElementById("dwc");
  var delivery_outof_colombo = document.getElementById("doc");
  var description = document.getElementById("des");
  var image = document.getElementByI("imageUploader");

  // alert(title.value);
  // alert(qty.value);
  // alert(delivery_within_colombo.value);
  // alert(delivery_outof_colombo.value);
  // alert(description.value);
  // alert(image.file[0]["tmp_name"]);

  var f = new FormData();
  f.append("t", title.value);
  f.append("s", qty.value);
  f.append("dwc", delivery_within_colombo.value);
  f.append("doc", delivery_outof_colombo.value);
  f.append("d", description.value);
  f.append("i", image.file[0]);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };

  r.open("POST", "updateProcess.php", true);
  r.send(f);
}

function basicSearch(x) {
  var txt = document.getElementById("basic_search_txt");
  var select = document.getElementById("basic_search_select");

  var f = new FormData();
  f.append("t", txt.value);
  f.append("s", select.value);
  f.append("page", x);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("basicSearchResult").innerHTML = t;
    }
  };

  r.open("POST", "basicSearchProcess.php", true);
  r.send(f);
}

function advancedSearch(x) {
  var search_text = document.getElementById("s1");
  var category = document.getElementById("c1");
  var brand = document.getElementById("b1");
  var model = document.getElementById("m1");
  var condition = document.getElementById("con");
  var color = document.getElementById("col");
  var price_from_txt = document.getElementById("pf");
  var price_to_txt = document.getElementById("pt");
  var sort = document.getElementById("sort");

  var form = new FormData();
  form.append("page", x);
  form.append("s", search_text.value);
  form.append("c", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("c1", condition.value);
  form.append("c2", color.value);
  form.append("p1", price_from_txt.value);
  form.append("p2", price_to_txt.value);
  form.append("sort", sort.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("view_area").innerHTML = t;
    }
  };

  r.open("POST", "advancedSearchProcess.php", true);
  r.send(form);
}

function loadMainImg(id) {
  // alert(id);
  var sample_img = document.getElementById("productImg" + id).src;
  var main_img = document.getElementById("mainImg");

  main_img.style.backgroundImage = "url(" + sample_img + ")";
}

function check_value(qty) {
  var input = document.getElementById("qtyInput");

  if (input.value <= 0) {
    alert("Product Quantity must be greater than 1.");
    input.value = "1";
  } else if (input.value > qty) {
    alert("Insufficient Quantity.");
    input.value = qty;
  }
}

function qty_inc(qty) {
  var input = document.getElementById("qtyInput");

  if (input.value < qty) {
    var newValue = parseInt(input.value) + 1;
    input.value = newValue.toString();
  } else {
    alert("Maximum quantity has achieved.");
  }
}

function qty_dec() {
  var input = document.getElementById("qtyInput");

  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1;
    input.value = newValue.toString();
  } else {
    alert("Minimum quantity has achieved.");
  }
}

function addToCard(id) {
  // alert(id);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      alert(t);
    }
  };

  r.open("GET", "addToCardProcess.php?id=" + id, true);
  r.send();
}

function deleteFromCart(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var txt = r.responseText;
      if (txt == "Success") {
        alert("Product removed from the cart.");
        window.location = "card.php";
      } else {
        alert(txt);
      }
    }
  };

  r.open("GET", "removeCartProcess.php?id= " + id, true);
  r.send();
}

function addToWatchList(id) {
  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;

      if (t == "Added") {
        document.getElementById("heart" + id).style.color = "red";
        window.location.reload();
      } else if (t == "Removed") {
        document.getElementById("heart" + id).style.color = "white";
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "addToWatchListProcess.php?id=" + id, true);
  r.send();
}

function removeFromWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4) {
      var t = request.responseText;

      if (t == "success") {
        window.location.reload();
      } else {
        alert(t);
      }
    }
  };

  request.open("GET", "removedWatchlistProcess.php?id=" + id, true);
  request.send();
}

function viewMessages(email) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      document.getElementById("chat_box").innerHTML = t;
    }
  };
  r.open("GET", "viewMessageProcess.php?email=" + email, true);
  r.send();
}

function sendMsg(email) {
  var receiver_mail = document.getElementById("rmail");
  var msg_txt = document.getElementById("msgTxt");

  var f = new FormData();
  // f.append("rm", receiver_mail.innerHTML);
  f.append("rm", email);
  f.append("mt", msg_txt.value);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        window.location = "message.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("POST", "sendMessageProcess.php", true);
  r.send(f);
}

function printInvoice() {
  var restorePage = document.body.innerHTML;
  var page = document.getElementById("page").innerHTML;
  document.body.innerHTML = page;
  window.print();
  document.body.innerHTML = restorePage;
}

var xm;

function adminVerification() {
  var e = document.getElementById("em");

  var f = new FormData();
  f.append("em", e.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if (t == "success") {
        var verificationModal = document.getElementById("verificationModal");
        xm = new bootstrap.Modal(verificationModal);
        xm.show();
      } else {
        alert(t);
      }
    }
  };
  r.open("POST", "adminVerificationProcess.php", true);
  r.send(f);
}

function verify() {
  var vcode = document.getElementById("vcode");
  var e = document.getElementById("em");

  var f = new FormData();
  f.append("em", e.value);
  f.append("vcode", vcode.value);

  var r = new XMLHttpRequest();

  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      if ((t = "success")) {
        window.location = "adminPanel.php";
      } else {
        alert(t);
      }
    }
  };

  r.open("GET", "verifyProcess.php", true);
  r.send(f);
}

var mm;

function viewmsgmodel() {
  var m = document.getElementById("viewMsgModal");
  mm = new bootstrap.Modal(m);
  mm.show();
}

var pm;

function viewProductModal(id) {
  var am = document.getElementById("viewproductmodal" + id);
  pm = new bootstrap.Modal(am);
  pm.show();
}

var cm;

function addNewCategory() {
  var am = document.getElementById("addCategoryMadal");
  cm = new bootstrap.Modal(am);
  cm.show();
}

var cvm;
var newCategory;
var uemail;

function categoryVerifyModal() {
  var m = document.getElementById("addCategoryModalVerification");
  cvm = new bootstrap.Modal(m);

  newCategory = document.getElementById("n").value;
  uemail = document.getElementById("e").value;

  var f = new FormData();
  f.append("n", newCategory);
  f.append("e", uemail);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var responce = r.responseText;

      if (responce == "success") {
        cm.hide();
        cvm.show();
      } else {
        alert(responce);
      }
    }
  };
  r.open("POST", "addNewCategoryProcess.php", true);
  r.send(f);
}

function saveCategory() {
  var text = document.getElementById("vtxt").value;
  var newCategory = document.getElementById("n").value;
  var uemail = document.getElementById("e").value;

  var f = new FormData();
  f.append("t", text);
  f.append("c", newCategory);
  f.append("e", uemail);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var responce = r.responseText;
      if (responce == "success") {
        window.location = "manageProducts.php";
      } else {
        alert(responce);
      }
    }
  };
  r.open("POST", "saveCategoryProcess.php", true);
  r.send(f);
}

function changeInvoiceId(id) {
  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      location.reload();
    }
  };
  r.open("GET", "changeInvoiceIdProcess.php?id=" + id, true);
  r.send();
}

function buynow(id) {
  var qty = document.getElementById("qtyInput").value;

  var f = new FormData();
  f.append("pid", id);
  f.append("qty", qty);
  // f.append("uniot_price", uniot_price);

  var r = new XMLHttpRequest();
  r.onreadystatechange = function () {
    if (r.readyState == 4) {
      var t = r.responseText;
      window.location = "invoice.php?order_id=" + t;
    }
  };
  r.open("POST", "buyNowProcess.php", true);
  r.send(f);
}

function blockProcess(email) {
  alert(email);

  // var block = document.getElementById("bl");
  // if (block.innerHTML == "Block") {
  //     block.innerHTML = "Unblock";
  //     block.style.background = "Green";
  // } else {
  //     block.innerHTML = "Block";
  //     block.style.background = "#dc3545";
  // }
}
