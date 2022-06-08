$(function(){

	var $imageContainer = $('#image-container');

	$('#image-file').change(function () {

		var src = window.URL.createObjectURL(this.files[0]);

		var $image = $('<img/>');

		$image.attr({src: src}).load(function () {

			$imageContainer.html($image);		

			$image.cropper({
			  aspectRatio: 16 / 9,
			  crop: function (e) {

			    $('#x').val(e.x);
			    $('#y').val(e.y);
			    $('#w').val(e.width);
			    $('#h').val(e.height);
			  }
			});
		})
	});
});