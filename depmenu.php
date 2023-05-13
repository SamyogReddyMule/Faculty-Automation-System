<style>
html { 
  background: url(Images/bg1.png) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
  margin: 0;
}
body {
  margin: 0px 0px 0px 0px;
}
  div.d1 {
    background-color: white; 
    justify-content: center; 
    display: flex;
  }
  nav.n1 {
  background-color: black;
  position: relative;
}
ul.u2 {
  display: none;
  background-color: black;
  padding: 0;
  position: absolute;
  top: 100%;
  list-style-type: none;
}
li.l3:hover > ul.u2 {
  display: block;
  backdrop-filter: blur(10px);
}
ul.u1:after {
  content: "";
  clear: both;
  display: block;
  backdrop-filter: blur(10px);
}
li.l3 {
  float: left;
  position: relative;
  list-style-type: none;
  border-radius: 5px;
}
li.l3:hover {
  background-color: black;
}
li.l3 a.a1 {
  display: block;
  padding: 10px 30px;
  text-decoration: none;
  font-family: 'Poppins',sans-serif;
  color: #ffffff;
  letter-spacing: 0.5px;
  border-radius: 5px;
}
li.l2 {
  float: center;
  position: relative;
}
li.l2 a.a1 {
  padding: 10px 50px;
  border-radius: 5px;
  align-content: center;
  backdrop-filter: blur(10px);
}
li.l2 a.a1:hover {
  background-color: black;
}
</style>

<div class="d1">
    <img src="Images/logo.jpg">
    <img  src="Images/title1.jpg">
</div>
<nav class="n1">
  <ul style="margin: 0px 0px 0px 0px;" class="u1">
    <li class="l3"><a class="a1" href="depb.php">Home</a></li>
    <li class="l3"><a class="a1" href="depcert.php">Faculty certifications Details</a>
    	<ul class="u2" style="margin: 0px 0px 0px 0px;">
        	<li class="l2"><a class="a1" href="depall.php">Faculty All Certifications</a></li>
        	<li class="l2"><a class="a1" href="depworkshop.php">Faculty Workshop Details</a></li>
        	<li class="l2"><a class="a1" href="depcourse.php"> Faculty Courses/Certificates Details</a></li>
        	<li class="l2"><a class="a1" href="depseminar.php"> Faculty Seminars Details</a></li>
        	<li class="l2"><a class="a1" href="depconference.php">Faculty Conference Details</a></li>
        	<li class="l2"><a class="a1" href="depppresent.php"> Faculty Paper Publications Details</a></li>
          <li class="l2"><a class="a1" href="depbooks.php"> Faculty Books Details</a></li>
    	</ul>
    </li>
    <li class="l3"><a class="a1" href="depach.php">Faculty Achievements Details</a>
    	<ul class="u2" style="margin: 0px 0px 0px 0px;">
        	<li class="l2"><a class="a1" href="depawards.php">Faculty Awards Details</a></li>
        	<li class="l2"><a class="a1" href="deppat.php">Faculty Patents Details</a></li>
        	<li class="l2"><a class="a1" href="depbooks.php">Faculty Books Details</a></li>
          <li class="l2"><a class="a1" href="depresp.php">Faculty Responsibilities Details</a></li>
          <li class="l2"><a class="a1" href="depmemb.php">Faculty Memberships Details</a></li>
          <li class="l2"><a class="a1" href="depproj.php">Faculty Projects Details</a></li>
    	</ul>
    </li>
    <li class="l3"><a class="a1" href="depwork.php">Faculty College Work Details</a>
    	<ul class="u2" style="margin: 0px 0px 0px 0px;">
        	<li class="l2"><a class="a1" href="depsub.php">Faculty Teached Subjects</a></li>
        	<li class="l2"><a class="a1" href="depleaves.php">Faculty Leaves</a></li>
        	<li class="l2"><a class="a1" href="depwl.php">Faculty Workload</a></li>
    	</ul>
    </li>
    <li class="l3"><a class="a1" href="depacc.php">Faculty Account Details</a>
    	<ul class="u2" style="margin: 0px 0px 0px 0px;">
        	<li class="l2"><a class="a1" href="depfac.php">All Faculty Details</a></li>
        	<li class="l2"><a class="a1" href="depfacd.php">Faculty Personal Details</a></li>
        	<li class="l2"><a class="a1" href="depedu.php">Faculty Education Details</a></li>
        	<li class="l2"><a class="a1" href="depexp.php">Faculty Experience Details</a></li>
        	<li class="l2"><a class="a1" href="deppwd.php">Change Password</a></li>
    	</ul>
    </li>
    <li class="l3"><a class="a1" href="logout.php">Logout</a>
  </ul>
</nav>