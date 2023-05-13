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
  background-color: grey;
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
  background-color: grey;
}
</style>

<div class="d1">
    <img src="Images/logo.jpg">
    <img  src="Images/title1.jpg">
</div>
<nav class="n1">
  <ul style="margin: 0px 0px 0px 0px;" class="u1">
    <li class="l3"><a class="a1" href="facultyb.php">Home</a></li>
    <li class="l3"><a class="a1" href="facultycert.php">Certifications</a>
    	<ul class="u2" style="margin: 0px 0px 0px 0px;">
        	<li class="l2"><a class="a1" href="facultyall.php">All</a></li>
        	<li class="l2"><a class="a1" href="facultyws.php">Workshop</a></li>
        	<li class="l2"><a class="a1" href="facultycc.php">Courses/Certificates</a></li>
        	<li class="l2"><a class="a1" href="facultysem.php">Seminars</a></li>
        	<li class="l2"><a class="a1" href="facultyconf.php">Conference</a></li>
        	<li class="l2"><a class="a1" href="facultypp.php">Paper Publications</a></li>
          <li class="l2"><a class="a1" href="facultybooks.php">Books</a></li>
        </ul>
    </li>
    <li class="l3"><a class="a1" href="facultyachall.php">Achievements</a>
    	<ul class="u2" style="margin: 0px 0px 0px 0px;">
          <li class="l2"><a class="a1" href="facultyachc.php">All</a></li>
        	<li class="l2"><a class="a1" href="facultyawards.php">Awards</a></li>
          <li class="l2"><a class="a1" href="facultypat.php">Patents</a></li>
          <li class="l2"><a class="a1" href="facultybooks.php">Books</a></li>
          <li class="l2"><a class="a1" href="facultyresp.php">Responsibilities</a></li>
          <li class="l2"><a class="a1" href="facultymem.php">Memberships</a></li>
          <li class="l2"><a class="a1" href="facultyproj.php">Projects</a></li>
          <li class="l2"><a class="a1" href="facultyskill.php">Skills</a></li>
      </ul>
    </li>
    
    <li class="l3"><a class="a1" href="facultywork.php">College Work</a></li>
    <li class="l3"><a class="a1" href="facultyacc.php">Account</a>
    	<ul class="u2" style="margin: 0px 0px 0px 0px;">
        	<li class="l2"><a class="a1" href="facultydts.php">Personal Details</a></li>
        	<li class="l2"><a class="a1" href="facultyedu.php">Education</a></li>
        	<li class="l2"><a class="a1" href="facultyexp.php">Experience</a></li>
        	<li class="l2"><a class="a1" href="facultypwd.php">Change Password</a></li>
    	</ul>
    </li>
    <li class="l3"><a class="a1" href="logout.php">Logout</a>
  </ul>
</nav>