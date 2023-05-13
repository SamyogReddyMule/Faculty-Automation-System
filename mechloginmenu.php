<style>
  html { 
  background: url(Images/it_dept.jpg) no-repeat center center fixed; 
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
    background-color:white; 
    justify-content: center; 
    display: flex;
  }
  nav.n1 {
  background-color: black;
}
ul.u2 {
  display: none;
  background-color: black;
  padding: 0;
  position: absolute;
  top: 100%;
  list-style-type: none;
}
li.l1:hover > ul.u2 {
  display: block;
}
ul.u1:after {
  content: "";
  clear: both;
  display: block;
}
li.l1 {
  float: left;
  position: relative;
  list-style-type: none;
  border-radius: 5px;
}
li.l1:hover {
  background-color: black;
}
li.l1 a.a1 {
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
    <li class="l1"><a class="a1" href="home.php">Home</a></li>
    <li class="l1"><a class="a1" >Login</a>
      <ul class="u2" style="margin: 0px 0px 0px 0px;">
        <li class="l2"><a class="a1" href="mechfacultylogin.php">Faculty</a></li>
        <li class="l2"><a class="a1" href="mechadminlogin.php">Administrator</a></li>
      </ul>
    </li>
  </ul>
</nav>