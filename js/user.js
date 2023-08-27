show_post();

// General Variable
var ajax_obj = null;

// show Posts on index home page
function show_post() {
  // alert("Asad");
  if (window.XMLHttpRequest) {
    ajax_obj = new XMLHttpRequest();
  } else {
    ajax_obj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajax_obj.open("GET", "index_ajax_process.php?action=show_post", true);
  ajax_obj.send();

  ajax_obj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
      document.getElementById("post_body").innerHTML = this.responseText;
    }
  };
  recent_post();
}

// show 5 Recent Posts on index page
function recent_post() {
  // alert("Asad")
  if (window.XMLHttpRequest) {
    ajax_obj = new XMLHttpRequest();
  } else {
    ajax_obj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajax_obj.open("GET", "index_ajax_process.php?action=recent_post", true);
  ajax_obj.send();

  ajax_obj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
      document.getElementById("recent_post_body").innerHTML = this.responseText;
    }
  };
}

// show Posts on user panel home page
function show_user_post() {
  if (window.XMLHttpRequest) {
    ajax_obj = new XMLHttpRequest();
  } else {
    ajax_obj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajax_obj.open("GET", "ajax_process.php?action=show_user_post", true);
  ajax_obj.send();

  ajax_obj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
      document.getElementById("post_body").innerHTML = this.responseText;
    }
  };
  recent_user_post();
}

// show 5 Recent Posts on user_panel
function recent_user_post() {
  // alert("Asad")
  if (window.XMLHttpRequest) {
    ajax_obj = new XMLHttpRequest();
  } else {
    ajax_obj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajax_obj.open("GET", "ajax_process.php?action=recent_user_post", true);
  ajax_obj.send();

  ajax_obj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      //Datatable jquery Function
      $(document).ready(function () {
        $("#myTable").DataTable();
      });
      document.getElementById("recent_post_body").innerHTML = this.responseText;
    }
  };
}

// Edit User's Profile
function edit_user_profile(user_id) {
  if (window.XMLHttpRequest) {
    ajax_obj = new XMLHttpRequest();
  } else {
    ajax_obj = new ActiveXObject("Microsoft.XMLHTTP");
  }
  ajax_obj.open("GET", "ajax_process.php?action=edit_user_profile&user_id="+user_id, true);
  ajax_obj.send();

  ajax_obj.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("edit_user_profile").innerHTML = this.responseText;
    }
  };
}
// follow Button
function follow_btn(blog_id) {
  var btn_follow = document.getElementById("follow_btn").innerHTML;
  var btn_unfollow = document.getElementById("follow_btn");
  var btn_refollow = document.getElementById("follow_btn");

  if (btn_follow === '<i class="fa fa-rss" aria-hidden="true"></i> Follow'){
    
    if (window.XMLHttpRequest) {
      ajax_obj = new XMLHttpRequest();
    } else {
      ajax_obj = new ActiveXObject("Microsoft.XMLHTTP");
    }
    ajax_obj.open("GET", "ajax_process.php?action=follow_btn&blog_id="+blog_id, true);
    ajax_obj.send();
  
    ajax_obj.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // document.getElementById("edit_user_profile").innerHTML = this.responseText;
        // console.log(this.responseText);
        alert(this.responseText)
      }
    };
    // console.log('matched.');
    btn_unfollow.innerHTML ='<i class="fa fa-rss" aria-hidden="true"></i> Unfollow';
  
  }
  else if(btn_unfollow.innerHTML ==='<i class="fa fa-rss" aria-hidden="true"></i> Unfollow'){
    
    if (window.XMLHttpRequest) {
      ajax_obj = new XMLHttpRequest();
    } else {
      ajax_obj = new ActiveXObject("Microsoft.XMLHTTP");
    }
    ajax_obj.open("GET", "ajax_process.php?action=unfollow_btn&blog_id="+blog_id, true);
    ajax_obj.send();
  
    ajax_obj.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        // document.getElementById("edit_user_profile").innerHTML = this.responseText;
        // console.log(this.responseText);
        alert(this.responseText)
      }
    };
    
    console.log("done");
    btn_refollow.innerHTML = '<i class="fa fa-rss" aria-hidden="true"></i> Follow'
  }
}


