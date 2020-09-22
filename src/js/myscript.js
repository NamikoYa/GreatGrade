$(document).ready(function() {
  $(".edit").click(function() {
    // only works for first line? Why?
    $(this).parents("tr").find("td:nth-child(2)").each(function(){
      let first = this.innerText;
      let last = this.nextSibling.innerText;
			console.log(first, " ", last);
		});
  });
});