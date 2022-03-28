function changeStatus(url){
//url: index.php?module=admin&controller=group&action=ajaxStatus&id=2&status=0
	//console.log(url);

	$.get(url, function(data){
		console.log(data);

		// $xhtml		= '<a class="jgrid" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\');">
		// <span class="state ' unpublish.'"></span>
		// 				</a>';

		var id = data[0];
		// status sau update
		var status = data[1];
		// link sau update
		var link = data[2];
		var element = 'a#status-' + id;
		var classRemove = 'publish';
		var classAdd = 'unpublish';
		if(status == 1)
		{
			// truong hop status dc -> 1 thi xoa icon unpublish
			classRemove = 'unpublish';
			classAdd = 'publish';
		}

		// update phan link
		$(element).attr('href',"javascript:changeStatus('"+link+"')");
		// update icon
		$(element + ' span').removeClass(classRemove).addClass(classAdd);

	}, 'json');

}

function changeACP(url){
	//url: index.php?module=admin&controller=group&action=ajaxStatus&id=2&status=0
		//console.log(url);
		//alert(1);
	
		$.get(url, function(data){
			console.log(data);
	
			// $xhtml		= '<a class="jgrid" id="group-acp-'.$id.'" href="javascript:changeStatus(\''.$link.'\');">
			// <span class="state ' unpublish.'"></span>
			// 				</a>';
	
			var id = data[0];
			var group_acp = data[1];
			var link = data[2];
			var element = 'a#group-acp-' + id;
			var classRemove = 'publish';
			var classAdd = 'unpublish';
			if(group_acp == 1)
			{
				// truong hop status dc -> 1 thi xoa icon unpublish
				classRemove = 'unpublish';
				classAdd = 'publish';
			}
	
			// update phan link
			$(element).attr('href',"javascript:changeACP('"+link+"')");
			// update icon
			$(element + ' span').removeClass(classRemove).addClass(classAdd);
	
		}, 'json');
	
	}

	function changeSpecial(url){
		//url: index.php?module=admin&controller=group&action=ajaxStatus&id=2&status=0
			//console.log(url);
		
			$.get(url, function(data){
				console.log(data);
		
				// $xhtml		= '<a class="jgrid" id="status-'.$id.'" href="javascript:changeStatus(\''.$link.'\');">
				// <span class="state ' unpublish.'"></span>
				// 				</a>';
		
				var id = data[0];
				// status sau update
				var special = data[1];
				// link sau update
				var link = data[2];
				var element = 'a#special-' + id;
				var classRemove = 'publish';
				var classAdd = 'unpublish';
				if(special == 1)
				{
					// truong hop status dc -> 1 thi xoa icon unpublish
					classRemove = 'unpublish';
					classAdd = 'publish';
				}
		
				// update phan link
				$(element).attr('href',"javascript:changeSpecial('"+link+"')");
				// update icon
				$(element + ' span').removeClass(classRemove).addClass(classAdd);
		
			}, 'json');
		
	}


function submitForm(url)
{
// url = index.php?module=admin&controller=group&action=status&type=1
	console.log(url);
	// change action="#" thanh url khi submit form
	$('#adminForm').attr('action',url);
	$('#adminForm').submit();
}

function submit()
{
	$('#adminForm').submit();
}

// function sortList(column, order){
// 	$('input[name=filter_column]').val(column);
// 	$('input[name=filter_column_dir]').val(order);
// 	$('#adminForm').submit();
// }

function changePage(page)
{
	//console.log(page);
	$('input[name=filter_page]').val(page);
	$('#adminForm').submit();
}



$(document).ready(function(){

	//alert(1);

	// ham` CHECK ALL
	$('input[name=checkall-toggle]').change(function(){
		//alert(1);
		// this la nut check All
		var checkStatus = this.checked;
		// duyet qua cac nut check Box trong form
		$('#adminForm').find(':checkbox').each(function(){
			this.checked = checkStatus;
		});
	});

	//button Search
	$('#filter-bar button[name=submit-keyword]').click(function()
	{
		//alert(1);
		$('#adminForm').submit();
	});

	//button Clear
	$('#filter-bar button[name=clear-keyword]').click(function(){
		$('input[name=filter_search]').val('');
		$('#adminForm').submit();
	});
	
	$('#filter-bar select[name=filter_state]').change(function(){
		//alert(1);
		$('#adminForm').submit();
	});

	$('#filter-bar select[name=filter_group_acp]').change(function(){
		//alert(1);
		$('#adminForm').submit();
	});

	$('#filter-bar select[name=filter_group_id]').change(function(){
		//alert(1);
		$('#adminForm').submit();
	});

	$('#filter-bar select[name=filter_category_id]').change(function(){
		//alert(1);
		$('#adminForm').submit();
	});

	$('#filter-bar select[name=filter_special]').change(function(){
		//alert(1);
		$('#adminForm').submit();
	});
	
	// $('#filter-bar select[name=filter_state]').change(function(){
	// 	$('#adminForm').submit();
	// })
	
	// $('#filter-bar select[name=filter_group_acp]').change(function(){
	// 	$('#adminForm').submit();
	// })
})





