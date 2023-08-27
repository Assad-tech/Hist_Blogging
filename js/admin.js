// General Varialble
var ajaxObj = null;

// Customize Blog btn
function customize_blog() {
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajaxObj.open("GET", "../admin/ajax-process.php?action=customize_blog", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
      document.getElementById("activity-body").innerHTML = this.responseText;
    }
  };
}

// Create Blog Button
function create_blog() {
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajaxObj.open("GET", "../admin/ajax-process.php?action=create_blog", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("activity-body").innerHTML = this.responseText;
    }
  };
}

// Edit Blog
function edit_blog(blog_id) {
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajaxObj.open(
    "GET",
    "../admin/ajax-process.php?action=edit_blog&blog_id=" + blog_id,
    true
  );
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("activity-body").innerHTML = this.responseText;
    }
  };
}

// Manage Categories
function manage_category(obj) {
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }

  ajaxObj.open("GET", "../admin/ajax-process.php?action=manage_category", true);
  ajaxObj.send();
  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByClassName("users")[0].classList.remove("active");
      document
        .getElementsByClassName("manage_post")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_comment")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_feedback")[0]
        .classList.remove("active");
      obj.parentElement.classList.add("active");

      document.getElementById("activity-body").innerHTML = this.responseText;
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    }
  };
}
// Add Category
function add_category() {
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajaxObj.open("GET", "../admin/ajax-process.php?action=add_category", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("activity-body").innerHTML = this.responseText;
    }
  };
}

// Create Category
function create_Category() {
  var category_title = document.getElementById("category_title").value;
  var category_description = document.getElementById(
    "category_description"
  ).value;
  var category_status = document.getElementById("category_status").value;

  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  // Using POST Method
  ajaxObj.open("POST", "../admin/ajax-process.php", true);
  ajaxObj.setRequestHeader("content-type", "application/x-www-form-urlencoded");
  ajaxObj.send(
    "action=create_Category&category_title=" +
      category_title +
      "&category_description=" +
      category_description +
      "&category_status=" +
      category_status +
      ""
  );

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("activity-body").innerHTML = this.responseText;
    }
  };
}

// Edit Category
function edit_category(category_id) {
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajaxObj.open(
    "GET",
    "../admin/ajax-process.php?action=edit_category&category_id=" + category_id,
    true
  );
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("activity-body").innerHTML = this.responseText;
    }
  };
}

// Manage Posts
function manage_post(obj) {
  if (window.XMLHttpRequest) {
    // alert("Asad");
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }

  ajaxObj.open("GET", "../admin/ajax-process.php?action=manage_post", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByClassName("users")[0].classList.remove("active");
      document
        .getElementsByClassName("manage_category")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_comment")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_feedback")[0]
        .classList.remove("active");
      obj.parentElement.classList.add("active");
      document.getElementById("activity-body").innerHTML = this.responseText;
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    }
  };
}

// Add Post
function add_post() {
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }

  ajaxObj.open("GET", "../admin/ajax-process.php?action=add_post", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("activity-body").innerHTML = this.responseText;
    }
  };
}

// manage Users btn
function manage_user(obj) {
  // alert('hello')
  if (window.XMLHttpRequest) {
    // alert("Manage Usrs");
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajaxObj.open("GET", "../admin/ajax-process.php?action=manage_user", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      obj.parentElement.classList.add("active");
      document
        .getElementsByClassName("manage_post")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_category")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_comment")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_feedback")[0]
        .classList.remove("active");
      // obj.classList.add("active")
      document.getElementById("activity-body").innerHTML = this.responseText;
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    }
  };
}

// Users Request btn
function user_request() {
  if (window.XMLHttpRequest) {
    // alert("Manage Usrs");
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajaxObj.open("GET", "../admin/ajax-process.php?action=user_request", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("activity-body").innerHTML = this.responseText;
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    }
  };
}

// Manage Comments
function manage_comment(obj) {
  // alert("Asad");
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }

  ajaxObj.open("GET", "../admin/ajax-process.php?action=manage_comment", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByClassName("users")[0].classList.remove("active");
      document
        .getElementsByClassName("manage_post")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_category")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_feedback")[0]
        .classList.remove("active");
      obj.parentElement.classList.add("active");
      document.getElementById("activity-body").innerHTML = this.responseText;
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    }
  };
}

// Manage Feedbacks
function manage_feedback(obj) {
  // alert("Asad");
  if (window.XMLHttpRequest) {
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }

  ajaxObj.open("GET", "../admin/ajax-process.php?action=manage_feedback", true);
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementsByClassName("users")[0].classList.remove("active");
      document
        .getElementsByClassName("manage_post")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_category")[0]
        .classList.remove("active");
      document
        .getElementsByClassName("manage_comment")[0]
        .classList.remove("active");
      obj.parentElement.classList.add("active");
      document.getElementById("activity-body").innerHTML = this.responseText;
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
    }
  };
}

// Edit Admin Profile to update
function edit_admin_profile(admin_id) {
  // alert("Asad");
  if (window.XMLHttpRequest) {
    // alert("Asad");
    ajaxObj = new XMLHttpRequest();
  } else {
    ajaxObj = new ActiveXObject("Microsoft.XMLHTTP");
  }

  ajaxObj.open(
    "GET",
    "../admin/ajax-process.php?action=edit_admin_profile&admin_id=" + admin_id,
    true
  );
  ajaxObj.send();

  ajaxObj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // alert("Asad");
      // console.log(this.responseText);
      document.getElementById("edit_admin_profile").innerHTML =
        this.responseText;
    }
  };
}

// User Panel Functions Now

// // Read more Funation on Post.
// function read_more() {
//   var dots = document.getElementById("dots");
//   var moreText = document.getElementById("more");
//   var btnText = document.getElementById("read_more_btn");
//   // console.log("btn id:"+btn_id);
//   if (dots.style.display === "none") {
//     dots.style.display = "inline";
//     btnText.innerHTML = "Read more";
//     moreText.style.display = "none";
//   } else {
//     dots.style.display = "none";
//     btnText.innerHTML = "Read less";
//     moreText.style.display = "inline";
//   }
// }

