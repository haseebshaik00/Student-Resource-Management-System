$(document).ready(function(){

		$("#searchBar").keyup(function()
	{
		var search = $(this).val();

		$.post('http://localhost/Mongo/ajax/search.php',{data_to_send : search},function(data){

			$("#bar").empty();
			var array = data.split(";");
			array.pop();
			$.each(array, function(index,value)
			{
				var element = '<option value=' + '"' + value + '"' + '> </option>';
				$("#bar").append(element);
			});

		});
	});

});