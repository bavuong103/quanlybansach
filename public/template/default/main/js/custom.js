function getUrlVar(key){
	var result = new RegExp(key + "=([^&]*)", "i").exec(window.location.search); 
	return result && unescape(result[1]) || ""; 
}

function changePage(page)
{
	//console.log(page);
	$('input[name=filter_page]').val(page);
	$('#adminForm').submit();
}

function submitForm(url)
{
// url = index.php?module=admin&controller=group&action=status&type=1
	console.log(url);
	// change action="#" thanh url khi submit form
	$('#adminForm').attr('action',url);
	$('#adminForm').submit();
}

// seleted tag on menu
$(document).ready(function(){
	// var controller = getUrlVar('controller');
	// alert(controller);
	var controller 	= (getUrlVar('controller') == '' ) ? 'index' : getUrlVar('controller');
	var action 		= (getUrlVar('action') == '' ) ? 'index' : getUrlVar('action');
	var classSelect = controller + '-' + action;
	$('#menu ul li.' + classSelect).addClass('selected');

	//button Search
	$('button[name=submit-keyword]').click(function()
	{
		//alert(1);
		$('#adminForm').submit();
	});

	//button Clear
	$('button[name=clear-keyword]').click(function(){
		$('input[name=filter_search]').val('');
		$('#adminForm').submit();
	});

});