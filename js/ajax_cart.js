function ajaxBuy(value)
{
	$.post('http://localhost/Mongo/ajax/buy.php', {item: value}, function(data){

	//console.log(data);

	if(data == "unregistered")
	{
		$("#loginWarning").modal('show');
	}
	else
	{
		$("#shopcart").html(data);
	}
	
	});
}
