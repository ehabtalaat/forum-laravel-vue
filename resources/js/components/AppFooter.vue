<template>
  <footer class="page-footer font-small blue">
    <div class="container">
      <div class="footer-copyright text-center py-3">
        © 2020 Copyright:
        <span>Ehab Talaat</span>
      </div>
    </div>
  </footer>
</template>
<script>
export default {};
</script>
<style scoped>
footer{
	position: relative;
	bottom: 0;
  width: 100%;
  background-color: #25ae80;
  margin-top: -2px;

}
footer .footer-copyright{
 margin: 0 auto !important;
 text-align: center;
 font-size: 16px;
 color: #333;
}
/*@media screen and (max-width: 890px){
footer{
	position: absolute;
}
footer .footer-copyright{
	display: block;
	margin: 0 auto !important;
 text-align: center;

}
}*/
</style>