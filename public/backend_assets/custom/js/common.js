$(function(){
	$('#txturl').on('keyup',function(){
		
		var url = slugfy($(this).val());
		$('#sluginput').val(url);
		$('#slugUrl').html(url);
	});
});
setTimeout(function(){ $('.alert').hide() }, 4000);
window.slugfy = function(text){
	return text.toString().toLowerCase()
	.replace(/\s+/g,'-')  //replace space with -
	.replace(/[^\w\-]+/g,'')  //remove non-word char
	.replace(/\-\-+/g,'-')  //replace multiple - to single -
	.replace(/^-+/,'')  //trim - from start of text
	.replace(/-+$/,''); //trim - from end of text
};
function confirmDelete(id){
		let choice = confirm('Are you sure,You want to deleted this record ?');
		if(choice){
			document.getElementById('confirm-delete-form-'+id).submit();
		}
	}