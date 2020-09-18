(function(window, undefined) {
  'use strict';

  /*
  NOTE:
  ------
  PLACE HERE YOUR OWN JAVASCRIPT CODE IF NEEDED
  WE WILL RELEASE FUTURE UPDATES SO IN ORDER TO NOT OVERWRITE YOUR JAVASCRIPT CODE PLEASE CONSIDER WRITING YOUR SCRIPT HERE.  */

	//


/********************************************************
* 														*
* 					*Category*	 						*
* 														*
********************************************************/

// ADD Category -> Btn open
$(".addtion-category").on('click', function(event){
		//$(".addtion-category-form")[0].reset();
		$('#catogry-table').hide(500);
		$('.addtion-category').hide(500);
		$(".addtion-category-form").show(500);
});
// /End ADD Category -> Btn open

// ADD Category -> Btn Close
$(".addtion-category-close").on('click', function(event){
		$(".addtion-category-form").hide(500);
		$('.addtion-category').show(500);
		$('#catogry-table').show(500);
});
// /End ADD Category -> Btn Close
	

// ADD Category -> Operation
$('#add-catgory').submit(function(event) {
	event.preventDefault();
	event.stopImmediatePropagation();
	var career_submit = document.getElementById("save");
	career_submit.disabled = true;
	var url = $(this).attr('action');
	//console.log(url);
	var formData = new FormData(this);
	$.ajax({
		type: 'POST',
		url: url,
		dataType: 'json',
		data: formData,
		beforeSend: function() {
			//console.log("before");
			$("#loading-image").show();
		},
		success: function (data) {
			// console.log("after");
			// console.log(data.msg);
			var error_msg = document.getElementById("error_msg");
			error_msg.innerHTML= data.msg;
			$("#loading-image").hide();
			$("#error_msg").fadeIn(2000);

			if(data.error === true) {
				career_submit.disabled = false;
			}else{
				//var suc_msg = document.getElementById("suc_msg");
				//suc_msg.innerHTML= data.msg;
				$("#loading-image").hide();
				$('#add-catgory').hide();
				$('#add-catgory')[0].reset();
				$("#error_msg").delay(1000).fadeOut();
				setTimeout(function(){
					$('.addtion-category-form').hide();
					//$( "#tbody-cat" ).empty();
					//$( "#tbody-cat" ).removeData();
					var tabledata = $('#tabledata').DataTable();
					// console.log(data.tables);
					var tables_info;
					$.each(data.tables, function(key, value){
						tables_info = "<span>";
						if(value.publication_status == 1){
							tables_info += '<a class="btn btn-green btn-sm mr-1 mb-1 pulication-category-btn"    data-link="'+window.location.origin+'/active-category/'+value.category_id+'"><i class="icon-like"></i></a>';
						}else{
							tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 pulication-category-btn"    data-link="'+window.location.origin+'/active-category/'+value.category_id+'"><i class="icon-dislike"></i></a>';
						}
						tables_info += '<a class="btn btn-info btn-sm mr-1 mb-1 edite-catgory-btn" data-link="'+window.location.origin+'/edit-category/'+value.category_id+'"><i class="icon-pencil"></i></a>';
						tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 remove-category-btn" data-link="'+window.location.origin+'/delete-category/'+value.category_id+'"><i class="icon-trash"></i></a>';
						tables_info += "</span>";
						if($('[name=lang]').val()== 'ar'){
							tabledata.row.add([ value.category_id, value.category_name_arabic, tables_info]).draw();
						}else{
							tabledata.row.add([ value.category_id, value.category_name, tables_info]).draw();
						}
					})
					
					$('#add-catgory').show();
					$('.addtion-category').show(500);
					$('#catogry-table').show(1000);
					career_submit.disabled = false;
				}, 1000);

			}

		},
		cache: false,
		contentType: false,
		processData: false
	});

});

// /End ADD Category -> Operation

// Active Category
$(document).on('click', '.active-category', function(e) {
	e.preventDefault();
	var url = $(this).attr('data-link');
	//var urlhome = $(this).attr('date-home');
	var data_id = $(this).attr('active-id');
	//console.log(url);
	//var formData = new FormData(this);
	$.ajax({
		type: 'get',
		url: url,
		dataType: 'json',
		beforeSend: function() {
			$('#loading-image').show();
			//console.log('before');
		},
		success: function (data) {
			//console.log('after');
			var active_id = $('*[active-id="'+data_id+'"]');
			if(data.msg == 1 )
			{
				//console.log('11111111');
				active_id.empty();
				active_id.removeClass('btn-danger');
				active_id.addClass('btn-green');
				active_id.append('<i class="icon-like"></i></i>');
			}else{
				//console.log('00000000000000');
				active_id.empty();
				active_id.removeClass('btn-green');
				active_id.addClass('btn-danger');
				active_id.append('<i class="icon-dislike"></i></i>');
			}

		},
		cache: false,
		contentType: false,
		processData: false
	});
});

// /End Category Active


//  Edie Category -> Btn open
$(document).on('click', '.edite-catgory-btn', function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
		var data_link = $(this).attr('data-link');
		// console.log(data_link);
		$.ajax({
			type: 'get',
			url: data_link,
			dataType: 'json',
			success: function(response) {
			//here I'd like back the php query
				console.log(response);
				var getdata  = response.result;
				$.each(getdata, function(key, value){
					$('[name='+ key +']').val(value);
			})
			
			}

		});

		$('#catogry-table').hide(500);
		$('.addtion-category').hide(500);
		$('.edite-category-form').show(500);
		
});	
// /End Edie Category -> Btn open

// Edie Category -> Btn Close 
$(".edite-category-close").on('click', function(event){
	$(".edite-category-form").hide(500);
	$('.addtion-category').show(500);
	$('#catogry-table').show(500);
});
// /End Edie Category -> Btn Close 



// Update Category -> Operation
$('#edite-catgory').submit(function(event) {
	event.preventDefault();
	event.stopImmediatePropagation();
	var career_submit = document.getElementById("update");
	career_submit.disabled = true;
	var urls = $(this).attr('action');
	// console.log(urls);
	var formData = new FormData(this);
	$.ajax({
		type: 'post',
		url: urls,
		dataType: 'json',
		data: formData,
		beforeSend: function() {
			// console.log("before");
			$("#loading-image").show();
		},
		success: function (data) {
			// console.log("after");
			// console.log(data.msg);
			var error_msg = document.getElementById("error_msg_ed");
			error_msg.innerHTML= data.msg;
			$("#loading-image").hide();
			$("#error_msg_ed").fadeIn(1000);

			if(data.error === true) {
				career_submit.disabled = false;
			}else{
				//var suc_msg = document.getElementById("suc_msg");
				//suc_msg.innerHTML= data.msg;
				$("#loading-image").hide();
				$('#edite-catgory').hide();
				$('#edite-catgory')[0].reset();
				$("#error_msg_ed").delay(1000).fadeOut();
				setTimeout(function(){
					$('.addtion-category-form').hide();
					//$( "#tbody-cat" ).empty();
					//$( "#tbody-cat" ).removeData();
					var tabledata = $('#tabledata').DataTable();
					// console.log(data.tables);
					var tables_info;
					$.each(data.tables, function(key, value){
						tables_info = "<span>";
						if(value.publication_status == 1){
							tables_info += '<a class="btn btn-green btn-sm mr-1 mb-1 pulication-category-btn"    data-link="'+window.location.origin+'/active-category/'+value.category_id+'"><i class="icon-like"></i></a>';
						}else{
							tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 pulication-category-btn"    data-link="'+window.location.origin+'/active-category/'+value.category_id+'"><i class="icon-dislike"></i></a>';
						}
						tables_info += '<a class="btn btn-info btn-sm mr-1 mb-1 edite-catgory-btn" data-link="'+window.location.origin+'/edit-category/'+value.category_id+'"><i class="icon-pencil"></i></a>';
						tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 remove-category-btn" data-link="'+window.location.origin+'/delete-category/'+value.category_id+'"><i class="icon-trash"></i></a>';
						tables_info += "</span>";
						if($('[name=lang]').val()== 'ar'){
							tabledata.row("#"+value.category_id).data([ value.category_id, value.category_name_arabic, tables_info]).draw();
						}else{
							tabledata.row("#"+value.category_id).data([ value.category_id, value.category_name, tables_info]).draw();
						}
					})

					$('.edite-category-form').hide();
					$('#edite-catgory').show(500);
					$('#catogry-table').show(1000);
					career_submit.disabled = false;
				}, 1000);

			}

		},
		cache: false,
		contentType: false,
		processData: false
	});

});

// /End Update Category -> Operation

// Delete Category -> Btn open
$(document).on('click', '.remove-category-btn', function(e){
	e.preventDefault();
	e.stopImmediatePropagation();
	var category_name = $(this).attr('data-name');
	$('#name').append(category_name);
	$('[name=category_id]').val($(this).attr('data-id'));
	$('#catogry-table').hide(500);
	$('.addtion-category').hide(500);
	$('.delete-category-form').show(500);
});
// /End Delete Category -> Btn open

// Delete Category -> Btn Close
 $(".delete-category-close").on('click', function(event){
		$(".delete-category-form").hide(500);
		$('.addtion-category').show(500);
		$('#catogry-table').show(500);
});
// /End Delete Category -> Btn Close

// Delete Category -> Operation
$('#delete-catgory').submit(function(event) {
	event.preventDefault();
	var career_submit = document.getElementById("remove");
	career_submit.disabled = true;
	var url = $(this).attr('action');
	// console.log(url);
	var formData = new FormData(this);
	$.ajax({
		type: 'post',
		url: url,
		dataType: 'json',
		data: formData,
		beforeSend: function() {
			// console.log("before");
			$("#loading-image").show();
		},
		success: function (data) {
			// console.log("after");
			var error_msg = document.getElementById("error_msg_down");
			error_msg.innerHTML= data.msg;
			$("#loading-image").hide();
			$("#error_msg_down").fadeIn(1000);

			if(data.error === true) {
				career_submit.disabled = false;
			}else{
				//var suc_msg = document.getElementById("suc_msg");
				//suc_msg.innerHTML= data.msg;
				$("#loading-image").hide();
				$('#delete-catgory').hide();
				$('#delete-catgory')[0].reset();
				$("#error_msg_down").delay(1000).fadeOut();
				setTimeout(function(){
					$('#article-drafts-delete').hide();
					var tabledata = $('#tabledata').DataTable();
					tabledata.row("#"+data.category_id).remove().draw();
					career_submit.disabled = false;
					$('.delete-category-form').hide();
					$('#delete-catgory').show();
					$('#catogry-table').show(1000);
				}, 1000);
			}
		},
		cache: false,
		contentType: false,
		processData: false
	});

});

// /End Delete Category -> Operation


/********************************************************
 * 														*
 * 					*Company*	 						*
 * 														*
 ********************************************************/

 // ADD Company -> Btn open
$(".addtion-company").on('click', function(event){
	//$(".addtion-category-form")[0].reset();
	$('#company-table').hide(500);
	$('.addtion-company').hide(500);
	$(".addtion-company-form").show(500);
});
 // /End ADD Company -> Btn open

// ADD Company -> Btn Close
$(".addtion-company-close").on('click', function(event){
	$(".addtion-company-form").hide(500);
	$('.addtion-company').show(500);
	$('#company-table').show(500);
});

// /End ADD Company -> Btn Close

// ADD Company -> Operation
$('#add-company').submit(function(event) {
event.preventDefault();
event.stopImmediatePropagation();
var career_submit = document.getElementById("save");
career_submit.disabled = true;
var url = $(this).attr('action');
// console.log(url);
var formData = new FormData(this);
$.ajax({
	type: 'POST',
	url: url,
	dataType: 'json',
	data: formData,
	beforeSend: function() {
		// console.log("before");
		$("#loading-image").show();
	},
	success: function (data) {
		// console.log("after");
		// console.log(data.msg);
		var error_msg = document.getElementById("error_msg");
		error_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$("#error_msg").fadeIn(2000);

		if(data.error === true) {
			career_submit.disabled = false;
		}else{
			//var suc_msg = document.getElementById("suc_msg");
			//suc_msg.innerHTML= data.msg;
			$("#loading-image").hide();
			$('#add-company').hide();
			$('#add-company')[0].reset();
			$("#error_msg").delay(1000).fadeOut();
			setTimeout(function(){
				$('.addtion-company-form').hide();
				//$( "#tbody-cat" ).empty();
				//$( "#tbody-cat" ).removeData();
				var tabledata = $('#tabledatac').DataTable();
				//console.log(data.tables);
				var tables_info;
				$.each(data.tables, function(key, value){
					// console.log("here");
					tables_info = "<span>";
					if(value.company_publication == 1){
						tables_info += '<a class="btn btn-green btn-sm mr-1 mb-1 pulication-company-btn"    data-link="'+window.location.origin+'/active-company/'+value.company_id+'"><i class="icon-like"></i></a>';
					}else{
						tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 pulication-company-btn"    data-link="'+window.location.origin+'/active-company/'+value.company_id+'"><i class="icon-dislike"></i></a>';
					}
					tables_info += '<a class="btn btn-info btn-sm mr-1 mb-1 edite-company-btn" data-link="'+window.location.origin+'/edit-company/'+value.company_id+'"><i class="icon-pencil"></i></a>';
					tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 remove-company-btn" data-link="'+window.location.origin+'/delete-company/'+value.company_id+'"><i class="icon-trash"></i></a>';
					tables_info += "</span>";
					if($('[name=lang]').val()== 'ar'){
						tabledata.row.add([ value.company_id, value.company_name_arabic, tables_info]).draw();
					}else{
						// console.log($('[name=lang]').val());
						tabledata.row.add([ value.company_id, value.company_name, tables_info]).draw();
					}
				})
				// console.log("here");
				$('#add-company').show();
				$('.addtion-company-form').hide(500);
				$('#company-table').show(1000);
				career_submit.disabled = false;
			}, 1000);

		}

	},
	cache: false,
	contentType: false,
	processData: false
});

});

// /End ADD Company -> Operation


// Edite Company -> Btn open 
$(document).on('click', '.edite-company-btn', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var data_link = $(this).attr('data-link');
// console.log(data_link);
$.ajax({
	type: 'get',
	url: data_link,
	dataType: 'json',
	success: function(response) {
	//here I'd like back the php query
		// console.log(response);
		var getdata  = response.result;
		$.each(getdata, function(key, value){
			$('[name='+ key +']').val(value);
	})
	
	}

});

$('#company-table').hide(500);
$('.addtion-company').hide(500);
$('.edite-company-form').show(500);

});

// / End Edite Company -> Btn  open


// Edite Company -> Btn Close
$(".edite-company-close").on('click', function(event){
$(".edite-company-form").hide(500);
$('.addtion-company').show(500);
$('#company-table').show(500);
});

// /End Edite Company -> Btn Close



// Active Company 

$(document).on('click', '.active-company', function(e) {
e.preventDefault();
var url = $(this).attr('data-link');
//var urlhome = $(this).attr('date-home');
var data_id = $(this).attr('active-id');
// console.log(url);
//var formData = new FormData(this);
$.ajax({
type: 'get',
url: url,
dataType: 'json',
beforeSend: function() {
	$('#loading-image').show();
	//console.log('before');
},
success: function (data) {
	//console.log('after');
	var active_id = $('*[active-id="'+data_id+'"]');
	if(data.msg == 1 )
	{
		//console.log('11111111');
		active_id.empty();
		active_id.removeClass('btn-danger');
		active_id.addClass('btn-green');
		active_id.append('<i class="icon-like"></i></i>');
	}else{
		//console.log('00000000000000');
		active_id.empty();
		active_id.removeClass('btn-green');
		active_id.addClass('btn-danger');
		active_id.append('<i class="icon-dislike"></i></i>');
	}

},
cache: false,
contentType: false,
processData: false
});
});

// /End Company Active


// Update Category -> Operation
$('#edite-company').submit(function(event) {
event.preventDefault();
event.stopImmediatePropagation();
var career_submit = document.getElementById("update");
career_submit.disabled = true;
var urls = $(this).attr('action');
// console.log(urls);
var formData = new FormData(this);
$.ajax({
type: 'post',
url: urls,
dataType: 'json',
data: formData,
beforeSend: function() {
	// console.log("before");
	$("#loading-image").show();
},
success: function (data) {
	// console.log("after");
	// console.log(data.msg);
	var error_msg = document.getElementById("error_msg_ed");
	error_msg.innerHTML= data.msg;
	$("#loading-image").hide();
	$("#error_msg_ed").fadeIn(1000);

	if(data.error === true) {
		career_submit.disabled = false;
	}else{
		//var suc_msg = document.getElementById("suc_msg");
		//suc_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$('#edite-company').hide();
		$('#edite-company')[0].reset();
		$("#error_msg_ed").delay(1000).fadeOut();
		setTimeout(function(){
			$('.addtion-company-form').hide();
			//$( "#tbody-cat" ).empty();
			//$( "#tbody-cat" ).removeData();
			var tabledata = $('#tabledatac').DataTable();
			// console.log(data.tables);
			var tables_info;
			$.each(data.tables, function(key, value){
				tables_info = "<span>";
				if(value.company_publication == 1){
					tables_info += '<a class="btn btn-green btn-sm mr-1 mb-1 pulication-company-btn"    data-link="'+window.location.origin+'/active-company/'+value.company_id+'"><i class="icon-like"></i></a>';
				}else{
					tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 pulication-company-btn"    data-link="'+window.location.origin+'/active-company/'+value.company_id+'"><i class="icon-dislike"></i></a>';
				}
				tables_info += '<a class="btn btn-info btn-sm mr-1 mb-1 edite-company-btn" data-link="'+window.location.origin+'/edit-company/'+value.company_id+'"><i class="icon-pencil"></i></a>';
				tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 remove-company-btn" data-link="'+window.location.origin+'/delete-company/'+value.company_id+'"><i class="icon-trash"></i></a>';
				tables_info += "</span>";
				if($('[name=lang]').val()== 'ar'){
					tabledata.row("#"+value.company_id).data([ value.company_id, value.company_name_arabic, tables_info]).draw();
				}else{
					tabledata.row("#"+value.company_id).data([ value.company_id, value.company_name, tables_info]).draw();
				}	
			})

			$('.edite-company-form').hide();
			$('#edite-company').show(500);
			$('#company-table').show(1000);
			career_submit.disabled = false;
		}, 1000);

	}

},
cache: false,
contentType: false,
processData: false
});

});

// /End Update Category -> Operation

// remove company -> Open
$(document).on('click', '.remove-company-btn', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var category_name = $(this).attr('data-name');
$('#name').append(category_name);
$('[name=company_id]').val($(this).attr('data-id'));
$('#company-table').hide(500);
$('.addtion-company').hide(500);
$('.delete-company-form').show(500);
});
// /End remove company -> Open

// remove company -> Close
$(".delete-company-close").on('click', function(event){
$(".delete-company-form").hide(500);
$('.addtion-company').show(500);
$('#company-table').show(500);
});
// /End remove company -> Close 

// Delete Category -> Operation
$('#delete-company').submit(function(event) {
event.preventDefault();
var career_submit = document.getElementById("remove");
career_submit.disabled = true;
var url = $(this).attr('action');
// console.log(url);
var formData = new FormData(this);
$.ajax({
type: 'post',
url: url,
dataType: 'json',
data: formData,
beforeSend: function() {
	// console.log("before");
	$("#loading-image").show();
},
success: function (data) {
	// console.log("after");
	var error_msg = document.getElementById("error_msg_down");
	error_msg.innerHTML= data.msg;
	$("#loading-image").hide();
	$("#error_msg_down").fadeIn(1000);

	if(data.error === true) {
		career_submit.disabled = false;
	}else{
		//var suc_msg = document.getElementById("suc_msg");
		//suc_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$('#delete-company').hide();
		$('#delete-company')[0].reset();
		$("#error_msg_down").delay(1000).fadeOut();
		setTimeout(function(){
			$('#article-drafts-delete').hide();
			var tabledata = $('#tabledatac').DataTable();
			tabledata.row("#"+data.company_id).remove().draw();
			career_submit.disabled = false;
			$('.delete-company-form').hide();
			$('#delete-company').show();
			$('#company-table').show(1000);
		}, 1000);
	}
},
cache: false,
contentType: false,
processData: false
});

});

// /Delete Company -> Operation



/********************************************************
 * 														*
 * 						*Brand*	 						*
 * 														*
 ********************************************************/

 // ADD Brand -> Btn open
 $(".addtion-brand").on('click', function(event){
	//$(".addtion-category-form")[0].reset();
	$('#brand-table').hide(500);
	$('.addtion-brand').hide(500);
	$(".addtion-brand-form").show(500);
});
 // /End ADD Brand -> Btn open

// ADD Brand -> Btn Close
$(".addtion-brand-close").on('click', function(event){
	$(".addtion-brand-form").hide(500);
	$('.addtion-brand').show(500);
	$('#brand-table').show(500);
});

// /End ADD Brand -> Btn Close

// ADD Brand -> Operation
$('#add-brand').submit(function(event) {
event.preventDefault();
event.stopImmediatePropagation();
var career_submit = document.getElementById("save");
career_submit.disabled = true;
var url = $(this).attr('action');
// console.log(url);
var formData = new FormData(this);
$.ajax({
	type: 'POST',
	url: url,
	dataType: 'json',
	data: formData,
	beforeSend: function() {
		// console.log("before");
		$("#loading-image").show();
	},
	success: function (data) {
		// console.log("after");
		// console.log(data.msg);
		var error_msg = document.getElementById("error_msg");
		error_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$("#error_msg").fadeIn(2000);

		if(data.error === true) {
			career_submit.disabled = false;
		}else{
			//var suc_msg = document.getElementById("suc_msg");
			//suc_msg.innerHTML= data.msg;
			$("#loading-image").hide();
			$('#add-brand').hide();
			$('#add-brand')[0].reset();
			$("#error_msg").delay(1000).fadeOut();
			setTimeout(function(){
				$('.addtion-brand-form').hide();
				//$( "#tbody-cat" ).empty();
				//$( "#tbody-cat" ).removeData();
				var tabledata = $('#tabledatab').DataTable();
				//console.log(data.tables);
				var tables_info;
				$.each(data.tables, function(key, value){
					//console.log("here");
					tables_info = "<span>";
					if(value.company_publication == 1){
						tables_info += '<a class="btn btn-green btn-sm mr-1 mb-1 pulication-brand-btn"    data-link="'+window.location.origin+'/active-brand/'+value.brand_id+'"><i class="icon-like"></i></a>';
					}else{
						tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 pulication-brand-btn"    data-link="'+window.location.origin+'/active-brand/'+value.brand_id+'"><i class="icon-dislike"></i></a>';
					}
					tables_info += '<a class="btn btn-info btn-sm mr-1 mb-1 edite-brand-btn" data-link="'+window.location.origin+'/edit-brand/'+value.brand_id+'"><i class="icon-pencil"></i></a>';
					tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 remove-brand-btn" data-link="'+window.location.origin+'/delete-brand/'+value.brand_id+'"><i class="icon-trash"></i></a>';
					tables_info += "</span>";
					if($('[name=lang]').val()== 'ar'){
						tabledata.row.add([ value.brand_id, value.brand_name_arabic, tables_info]).draw();
					}else{
						console.log($('[name=lang]').val());
						tabledata.row.add([ value.brand_id, value.brand_name, tables_info]).draw();
					}
				})
				//console.log("here");
				$('#add-brand').show();
				$('.addtion-brand-form').hide(500);
				$('#brand-table').show(1000);
				career_submit.disabled = false;
			}, 1000);

		}

	},
	cache: false,
	contentType: false,
	processData: false
});

});

// /End ADD Brand -> Operation

// Active Brand 
$(document).on('click', '.active-brand', function(e) {
	e.preventDefault();
	var url = $(this).attr('data-link');
	//var urlhome = $(this).attr('date-home');
	var data_id = $(this).attr('active-id');
	//console.log(url);
	//var formData = new FormData(this);
	$.ajax({
	type: 'get',
	url: url,
	dataType: 'json',
	beforeSend: function() {
		$('#loading-image').show();
		//console.log('before');
	},
	success: function (data) {
		//console.log('after');
		var active_id = $('*[active-id="'+data_id+'"]');
		if(data.msg == 1 )
		{
			//console.log('11111111');
			active_id.empty();
			active_id.removeClass('btn-danger');
			active_id.addClass('btn-green');
			active_id.append('<i class="icon-like"></i></i>');
		}else{
			//console.log('00000000000000');
			active_id.empty();
			active_id.removeClass('btn-green');
			active_id.addClass('btn-danger');
			active_id.append('<i class="icon-dislike"></i></i>');
		}
	
	},
	cache: false,
	contentType: false,
	processData: false
	});
});
	
// /End Brand Active
	
// Edite Brand -> Btn open 
$(document).on('click', '.edite-brand-btn', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var data_link = $(this).attr('data-link');
// console.log(data_link);
$.ajax({
	type: 'get',
	url: data_link,
	dataType: 'json',
	success: function(response) {
	//here I'd like back the php query
		// console.log(response);
		var getdata  = response.result;
		$.each(getdata, function(key, value){
			$('[name='+ key +']').val(value);
	})
	
	}

});

$('#brand-table').hide(500);
$('.addtion-brand').hide(500);
$('.edite-brand-form').show(500);

});

// / End Edite Brand -> Btn  open


// Edite Brand -> Btn Close
$(".edite-brand-close").on('click', function(event){
$(".edite-brand-form").hide(500);
$('.addtion-brand').show(500);
$('#brand-table').show(500);
});

// /End Edite Brand -> Btn Close




// Update Brand -> Operation
$('#edite-brand').submit(function(event) {
event.preventDefault();
event.stopImmediatePropagation();
var career_submit = document.getElementById("update");
career_submit.disabled = true;
var urls = $(this).attr('action');
//console.log(urls);
var formData = new FormData(this);
$.ajax({
type: 'post',
url: urls,
dataType: 'json',
data: formData,
beforeSend: function() {
	//console.log("before");
	$("#loading-image").show();
},
success: function (data) {
	//console.log("after");
	//console.log(data.msg);
	var error_msg = document.getElementById("error_msg_ed");
	error_msg.innerHTML= data.msg;
	$("#loading-image").hide();
	$("#error_msg_ed").fadeIn(1000);

	if(data.error === true) {
		career_submit.disabled = false;
	}else{
		//var suc_msg = document.getElementById("suc_msg");
		//suc_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$('#edite-brand').hide();
		$('#edite-brand')[0].reset();
		$("#error_msg_ed").delay(1000).fadeOut();
		setTimeout(function(){
			$('.addtion-brand-form').hide();
			//$( "#tbody-cat" ).empty();
			//$( "#tbody-cat" ).removeData();
			var tabledata = $('#tabledatab').DataTable();
			// console.log(data.tables);
			var tables_info;
			$.each(data.tables, function(key, value){
				tables_info = "<span>";
				if(value.brand_publication == 1){
					tables_info += '<a class="btn btn-green btn-sm mr-1 mb-1 mg pulication-brand-btn"    data-link="'+window.location.origin+'/active-brand/'+value.brand_id+'"><i class="icon-like"></i></a>';
				}else{
					tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 mg pulication-brand-btn"    data-link="'+window.location.origin+'/active-brand/'+value.brand_id+'"><i class="icon-dislike"></i></a>';
				}
				tables_info += '<a class="btn btn-info btn-sm mr-1 mb-1 mg edite-brand-btn" data-link="'+window.location.origin+'/edit-brand/'+value.brand_id+'"><i class="icon-pencil"></i></a>';
				tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 mg remove-brand-btn" data-link="'+window.location.origin+'/delete-brand/'+value.brand_id+'"><i class="icon-trash"></i></a>';
				tables_info += "</span>";
				if($('[name=lang]').val()== 'ar'){
					tabledata.row("#"+value.brand_id).data([ value.brand_id, value.brand_name_arabic, tables_info]).draw();
				}else{
					tabledata.row("#"+value.brand_id).data([ value.brand_id, value.brand_name, tables_info]).draw();
				}	
			})

			$('.edite-brand-form').hide();
			$('#edite-brand').show(500);
			$('#brand-table').show(1000);
			career_submit.disabled = false;
		}, 1000);

	}

},
cache: false,
contentType: false,
processData: false
});

});

// /End Update Brand -> Operation

// remove Brand -> Open
$(document).on('click', '.remove-brand-btn', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var brand_name = $(this).attr('data-name');
$('#name').append(brand_name);
console.log('here');
$('[name=brand_id]').val($(this).attr('data-id'));
$('#brand-table').hide(500);
$('.addtion-brand').hide(500);
$('.delete-brand-form').show(500);
});
// /End remove Brand -> Open

// remove Brand -> Close
$(".delete-brand-close").on('click', function(event){
$(".delete-brand-form").hide(500);
$('.addtion-brandy').show(500);
$('#brand-table').show(500);
});
// /End remove Brand -> Close 

// Delete Brand -> Operation
$('#delete-brand').submit(function(event) {
event.preventDefault();
var career_submit = document.getElementById("remove");
career_submit.disabled = true;
var url = $(this).attr('action');
console.log(url);
var formData = new FormData(this);
$.ajax({
type: 'post',
url: url,
dataType: 'json',
data: formData,
beforeSend: function() {
	console.log("before");
	$("#loading-image").show();
},
success: function (data) {
	console.log("after");
	var error_msg = document.getElementById("error_msg_down");
	error_msg.innerHTML= data.msg;
	$("#loading-image").hide();
	$("#error_msg_down").fadeIn(1000);

	if(data.error === true) {
		career_submit.disabled = false;
	}else{
		//var suc_msg = document.getElementById("suc_msg");
		//suc_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$('#delete-brand').hide();
		$('#delete-brand')[0].reset();
		$("#error_msg_down").delay(1000).fadeOut();
		setTimeout(function(){
			$('#article-drafts-delete').hide();
			var tabledata = $('#tabledatab').DataTable();
			tabledata.row("#"+data.brand_id).remove().draw();
			career_submit.disabled = false;
			$('.delete-brand-form').hide();
			$('#delete-brand').show();
			$('#brand-table').show(1000);
		}, 1000);
	}
},
cache: false,
contentType: false,
processData: false
});

});

// /Delete Brand -> Operation




/********************************************************
 * 														*
 * 						*product*	 					*
 * 														*
 ********************************************************/

 // ADD product -> Btn open
 $(".addtion-products").on('click', function(event){
	//$(".addtion-category-form")[0].reset();
	$('#products-table').hide(500);
	$('.addtion-products').hide(500);
	$(".addtion-products-form").show(500);
});
 // /End ADD product -> Btn open

// ADD product -> Btn Close
$(".addtion-products-close").on('click', function(event){
	$(".addtion-products-form").hide(500);
	$('.addtion-products').show(500);
	$('#products-table').show(500);
});

// /End ADD product -> Btn Close


// ADD product -> Show Sub Category

$( "#category_id" ).change(function(e) {
	e.preventDefault();
	var categoryid = ($('select[name=category_parent]').val());
	//console.log(idcategory);
	if(categoryid != 0){
		var url = $(this).attr('data-link')+'/'+categoryid;
		//console.log(urls);
		//var formData = new FormData(this);
		$.ajax({
			type: 'get',
			url: url,
			dataType: 'json',
			success: function(response) {
			//here I'd like back the php query
				console.log('after');
				$('#subcategory').hide(500);
				$('#subcategory').empty();
				$('#loading-image').hide();
				var result = response.subcategory;
				console.log(result);
				if(result.length > 0){

					if($('[name=lang]').val()== 'ar'){
					var select_info = "<select class='form-control' name='subcategoryid'>";
					select_info += "<option value='0'>اختر المجموعة الفرعية </option>";
					$.each(result, function(key, value){
						//console.log( result);
						select_info += "<option value="+value.category_id+">"+value.category_name_arabic+"</option>";
					})
					}else{
						var select_info = "<select class='form-control' name='subcategoryid'>";
						select_info += "<option value='0'>Choose Sub Group </option>";
						$.each(result, function(key, value){
							//console.log( result);
							select_info += "<option value="+value.category_id+">"+value.category_name+"</option>";
						})
					}
					select_info += "</select>";
					$('#subcategory').append(select_info);
					$('#subcategory').show(500);
				}

			}

		});

	}else{
		$('#subcategory').hide(500);
	}


});
// End ADD product -> Show Sub Category


// ADD product -> Operation
$('#add-products').submit(function(event) {
event.preventDefault();
event.stopImmediatePropagation();
var career_submit = document.getElementById("save");
career_submit.disabled = true;
var url = $(this).attr('action');
console.log(url);
var formData = new FormData(this);
$.ajax({
	type: 'POST',
	url: url,
	dataType: 'json',
	data: formData,
	beforeSend: function() {
		console.log("before");
		$("#loading-image").show();
	},
	success: function (data) {
		// console.log("after");
		// console.log(data.msg);
		var error_msg = document.getElementById("error_msg");
		error_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$("#error_msg").fadeIn(2000);

		if(data.error === true) {
			career_submit.disabled = false;
		}else{
			//var suc_msg = document.getElementById("suc_msg");
			//suc_msg.innerHTML= data.msg;
			$("#loading-image").hide();
			$('#add-products').hide();
			$('#add-products')[0].reset();
			$("#error_msg").delay(1000).fadeOut();
			setTimeout(function(){
				$('.addtion-products-form').hide();
				//$( "#tbody-cat" ).empty();
				//$( "#tbody-cat" ).removeData();
				var tabledata = $('#tabledatap').DataTable();
				//console.log(data.tables);
				var tables_info;
				var img_info;
				$.each(data.tables, function(key, value){
					//console.log("here");
					tables_info = "<span>";
					if(value.products_publication == 1){
						tables_info += '<a class="btn btn-green btn-sm mr-1 mb-1 pulication-brand-btn"    data-link="'+window.location.origin+'/active-brand/'+value.products_id+'"><i class="icon-like"></i></a>';
					}else{
						tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 pulication-brand-btn"    data-link="'+window.location.origin+'/active-brand/'+value.products_id+'"><i class="icon-dislike"></i></a>';
					}
					tables_info += '<a class="btn btn-info btn-sm mr-1 mb-1 edite-brand-btn" data-link="'+window.location.origin+'/edit-brand/'+value.products_id+'"><i class="icon-pencil"></i></a>';
					tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 remove-brand-btn" data-link="'+window.location.origin+'/delete-brand/'+value.products_id+'"><i class="icon-trash"></i></a>';
					tables_info += "</span>";
					
					img_info = '<img src="'+window.location.origin+'/'+value.products_image1+'" width="50"/>';
					img_info += '<img src="'+window.location.origin+'/'+value.products_image2+'" width="50"/>';
					img_info += '<img src="'+window.location.origin+'/'+value.products_image3+'" width="50"/>';
					img_info += '<img src="'+window.location.origin+'/'+value.products_image4+'" width="50"/>';
					if($('[name=lang]').val()== 'ar'){
						tabledata.row.add([value.products_id, value.products_name_arabic, tables_info, img_info]).draw();
					}else{
						console.log($('[name=lang]').val());
						tabledata.row.add([value.products_id, value.products_name, tables_info, img_info]).draw();
					}
				})
				//console.log("here");
				$('#add-products').show();
				$('.addtion-products-form').hide(500);
				$('#products-table').show(1000);
				career_submit.disabled = false;
			}, 1000);

		}

	},
	cache: false,
	contentType: false,
	processData: false
});

});

// /End ADD product -> Operation

// Active product 
$(document).on('click', '.active-products', function(e) {
	e.preventDefault();
	var url = $(this).attr('data-link');
	//var urlhome = $(this).attr('date-home');
	var data_id = $(this).attr('active-id');
	console.log(url);
	//var formData = new FormData(this);
	$.ajax({
	type: 'get',
	url: url,
	dataType: 'json',
	beforeSend: function() {
		$('#loading-image').show();
		//console.log('before');
	},
	success: function (data) {
		//console.log('after');
		var active_id = $('*[active-id="'+data_id+'"]');
		if(data.msg == 1 )
		{
			//console.log('11111111');
			active_id.empty();
			active_id.removeClass('btn-danger');
			active_id.addClass('btn-green');
			active_id.append('<i class="icon-like"></i></i>');
		}else{
			//console.log('00000000000000');
			active_id.empty();
			active_id.removeClass('btn-green');
			active_id.addClass('btn-danger');
			active_id.append('<i class="icon-dislike"></i></i>');
		}
	
	},
	cache: false,
	contentType: false,
	processData: false
	});
});
	
// /End product Active
	
// Edite product -> Btn open 
$(document).on('click', '.edite-products-btn', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var data_link = $(this).attr('data-link');
console.log(data_link);
$.ajax({
	type: 'get',
	url: data_link,
	dataType: 'json',
	success: function(response) {
	//here I'd like back the php query
		// console.log(response);
		$('[name=category_edite]').val(response.maincategory);
		//console.log(data.allsubcategory);
		var select_info = "<select class='form-control' name='subcategoryid'>";
		select_info += "<option value='0'>Choose Sub Category</option>";
		$.each(response.allsubcategory, function(key, value){
			//console.log( result);
			select_info += "<option value='"+value.category_id+"'>"+value.category_name+' - '+value.category_name_arabic+"</option>";
		})
		select_info += "</select>";
		//console.log(select_info);
		$('#subcategoryedite').append(select_info);
		$('#subcategoryedite').show();
		$('[name=subcategoryid]').val(response.subcategory);

		///////
		var getdata  = response.result;
		$.each(getdata, function(key, value){
				if(key =='products_image1' || key =='products_image2' || key =='products_image3'|| key =='products_image4'){
					
				}else{
					console.log(key);
					$('[name='+ key +']').val(value);
				}
				
			
		})
	
	}

});
// End Edite product -> Btn open 

// edite product -> Show Sub category

$( "#category_edite_id" ).change(function(e) {
	e.preventDefault();
	var categoryid = ($('select[name=category_edite]').val());
	//console.log(idcategory);
	if(categoryid != 0){
		var url = $(this).attr('data-link')+'/'+categoryid;
		//console.log(urls);
		//var formData = new FormData(this);
		$.ajax({
			type: 'get',
			url: url,
			dataType: 'json',
			success: function(response) {
			//here I'd like back the php query
				console.log('after');
				$('#subcategoryedite').hide(500);
				$('#subcategoryedite').empty();
				$('#loading-image').hide();
				var result = response.subcategory;
				console.log(result);
				if(result.length > 0){

					if($('[name=lang]').val()== 'ar'){
					var select_info = "<select class='form-control' name='subcategoryid'>";
					select_info += "<option value='0'>اختر المجموعة الفرعية </option>";
					$.each(result, function(key, value){
						//console.log( result);
						select_info += "<option value="+value.category_id+">"+value.category_name_arabic+"</option>";
					})
					}else{
						var select_info = "<select class='form-control' name='subcategoryid'>";
						select_info += "<option value='0'>Choose Sub Group </option>";
						$.each(result, function(key, value){
							//console.log( result);
							select_info += "<option value="+value.category_id+">"+value.category_name+"</option>";
						})
					}
					select_info += "</select>";
					$('#subcategoryedite').append(select_info);
					$('#subcategoryedite').show(500);
				}

			}

		});

	}else{
		$('#subcategoryedite').hide(500);
	}


});
// End edite product -> Show Sub category


$('#products-table').hide(500);
$('.addtion-products').hide(500);
$('.edite-products-form').show(500);

});

// / End Edite product -> Btn  open


// Edite product -> Btn Close
$(".edite-products-close").on('click', function(event){
$(".edite-products-form").hide(500);
$('.addtion-products').show(500);
$('#products-table').show(500);
});

// /End Edite product -> Btn Close




// Update Brand -> Operation
$('#edite-products').submit(function(event) {
event.preventDefault();
event.stopImmediatePropagation();
var career_submit = document.getElementById("update");
career_submit.disabled = true;
var urls = $(this).attr('action');
console.log(urls);
var formData = new FormData(this);
$.ajax({
type: 'post',
url: urls,
dataType: 'json',
data: formData,
beforeSend: function() {
	console.log("before");
	$("#loading-image").show();
},
success: function (data) {
	console.log("after");
	//console.log(data.msg);
	var error_msg = document.getElementById("error_msg_ed");
	error_msg.innerHTML= data.msg;
	$("#loading-image").hide();
	$("#error_msg_ed").fadeIn(1000);

	if(data.error === true) {
		career_submit.disabled = false;
	}else{
		//var suc_msg = document.getElementById("suc_msg");
		//suc_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$('#edite-products').hide();
		$('#edite-products')[0].reset();
		$("#error_msg_ed").delay(1000).fadeOut();
		setTimeout(function(){
			$('.edite-products-form').hide();
			//$( "#tbody-cat" ).empty();
			//$( "#tbody-cat" ).removeData();
			var tabledata = $('#tabledatap').DataTable();
			// console.log(data.tables);
			var tables_info;
			var img_info;
			$.each(data.tables, function(key, value){
				//console.log("here");
				tables_info = "<span>";
				if(value.products_publication == 1){
					tables_info += '<a class="btn btn-green btn-sm mr-1 mb-1 pulication-brand-btn"    data-link="'+window.location.origin+'/active-brand/'+value.products_id+'"><i class="icon-like"></i></a>';
				}else{
					tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 pulication-brand-btn"    data-link="'+window.location.origin+'/active-brand/'+value.products_id+'"><i class="icon-dislike"></i></a>';
				}
				tables_info += '<a class="btn btn-info btn-sm mr-1 mb-1 edite-brand-btn" data-link="'+window.location.origin+'/edit-brand/'+value.products_id+'"><i class="icon-pencil"></i></a>';
				tables_info += '<a class="btn btn-danger btn-sm mr-1 mb-1 remove-brand-btn" data-link="'+window.location.origin+'/delete-brand/'+value.products_id+'"><i class="icon-trash"></i></a>';
				tables_info += "</span>";
				
				img_info = '<img src="'+window.location.origin+'/'+value.products_image1+'" width="50"/>';
				img_info += '<img src="'+window.location.origin+'/'+value.products_image2+'" width="50"/>';
				img_info += '<img src="'+window.location.origin+'/'+value.products_image3+'" width="50"/>';
				img_info += '<img src="'+window.location.origin+'/'+value.products_image4+'" width="50"/>';
				if($('[name=lang]').val()== 'ar'){
					tabledata.row("#"+value.products_id).data([value.products_id, value.products_name_arabic, tables_info, img_info]).draw();
				}else{
					console.log($('[name=lang]').val());
					tabledata.row("#"+value.products_id).data([value.products_id, value.products_name, tables_info, img_info]).draw();
				}
			})

			$('.edite-products-form').hide();
			$('#edite-products').show(500);
			$('#products-table').show(1000);
			career_submit.disabled = false;
		}, 1000);

	}

},
cache: false,
contentType: false,
processData: false
});

});

// /End Update Product -> Operation

// Remove Product -> Open
$(document).on('click', '.remove-products-btn', function(e){
e.preventDefault();
e.stopImmediatePropagation();
var brand_name = $(this).attr('data-name');
$('#name').append(brand_name);
console.log('here');
$('[name=products_id]').val($(this).attr('data-id'));
$('#products-table').hide(500);
$('.addtion-products').hide(500);
$('.delete-products-form').show(500);
});
// /End remove company -> Open

// remove company -> Close
$(".delete-products-close").on('click', function(event){
$(".delete-products-form").hide(500);
$('.addtion-products').show(500);
$('#products-table').show(500);
});
// /End Remove Product -> Close 

// Delete Category -> Operation
$('#delete-products').submit(function(event) {
event.preventDefault();
var career_submit = document.getElementById("remove");
career_submit.disabled = true;
var url = $(this).attr('action');
console.log(url);
var formData = new FormData(this);
$.ajax({
type: 'post',
url: url,
dataType: 'json',
data: formData,
beforeSend: function() {
	console.log("before");
	$("#loading-image").show();
},
success: function (data) {
	console.log("after");
	var error_msg = document.getElementById("error_msg_down");
	error_msg.innerHTML= data.msg;
	$("#loading-image").hide();
	$("#error_msg_down").fadeIn(1000);

	if(data.error === true) {
		career_submit.disabled = false;
	}else{
		//var suc_msg = document.getElementById("suc_msg");
		//suc_msg.innerHTML= data.msg;
		$("#loading-image").hide();
		$('#delete-products').hide();
		$('#delete-products')[0].reset();
		$("#error_msg_down").delay(1000).fadeOut();
		setTimeout(function(){
			$('#article-drafts-delete').hide();
			var tabledata = $('#tabledatap').DataTable();
			tabledata.row("#"+data.product_id).remove().draw();
			career_submit.disabled = false;
			$('.delete-products-form').hide();
			$('#delete-products').show();
			$('#products-table').show(1000);
		}, 1000);
	}
},
cache: false,
contentType: false,
processData: false
});

});

// /Delete Company -> Operation


})(window);

