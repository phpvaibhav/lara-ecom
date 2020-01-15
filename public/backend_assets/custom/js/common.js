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

$('#thumbnail').on('change', function() {
var file = $(this).get(0).files;
var reader = new FileReader();
reader.readAsDataURL(file[0]);
reader.addEventListener("load", function(e) {
var image = e.target.result;
$("#imgthumbnail").attr('src', image);
});
});

$('#btn-add').on('click', function(e){
	
		var count = $('.options').length+1;
		var url = $('#extraItems').data('url');
		$.get(url).done(function(data){
			
			$('#extras').append(data);
		})
})
$('#btn-remove').on('click', function(e){	
	$('.options:last').remove();
})
$('#featured').on('change', function(){
	if($(this).is(":checked"))
		$(this).val(1)
	else
		$(this).val(0)
})
