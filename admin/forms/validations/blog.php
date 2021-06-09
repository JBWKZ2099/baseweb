<script src="https://cdn.ckeditor.com/4.15.0/full/ckeditor.js"></script>

<script>
	$(function(){
		$("#form-validation").formValidation({
			locale: "es_ES",
			fields: {
				name: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 3,
							max: 255
						}
					}
				},
				author: {
					validators: {
						notEmpty: {}
					}
				},
				meta: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 3,
							max: 150
						}
					}
				},
				meta_keywords: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 3,
							max: 255
						}
					}
				},
				cover: {
					validators: {
						notEmpty: {},
						file: {
							extension: 'jpeg,jpg,png',
							type: 'image/jpeg,image/png'
						}
					}
				},
				cover_alt: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 3,
							max: 255
						}
					}
				},
				files: {
					validators: {
						notEmpty: {},
						file: {
							extension: 'jpeg,jpg,png',
							type: 'image/jpeg,image/png'
						}
					}
				},
				img_alt: {
					validators: {
						notEmpty: {},
						stringLength: {
							min: 3,
							max: 255
						}
					}
				},
				body: {
					validators: {
						notEmpty: {}
					}
				},
				status: {
					validators: {
						notEmpty: {}
					}
				}
			}
		});

		// $("#category-container")show();
		// $("#subcategory-container")show();

		$(`[name="has_cat"]`).click(function(e){
			if( $(this).val()==1 ){
				$("#category-container").show();

				$("#form-validation").formValidation("addField", "category", {
					validators: {
						notEmpty: {}
					}
				});
			} else {
				$("#category-container").hide();

				$("#form-validation").formValidation("removeField", "category", {
					validators: {
						notEmpty: {}
					}
				});
			}

			// console.log( $(this).val() );
		});
		$(`[name="has_subcat"]`).click(function(e){
			if( $(this).val()==1 ){
				$("#subcategory-container").show();

				$("#form-validation").formValidation("addField", "subcategory", {
					validators: {
						notEmpty: {}
					}
				});
			} else {
				$("#subcategory-container").hide();

				$("#form-validation").formValidation("removeField", "subcategory", {
					validators: {
						notEmpty: {}
					}
				});
			}

			// console.log( $(this).val() );
		});

		tbgroups = [
		    { name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		    { name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		    { name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		    { name: 'forms', groups: [ 'forms' ] },
		    { name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		    { name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		    { name: 'links', groups: [ 'links' ] },
		    { name: 'insert', groups: [ 'insert' ] },
		    { name: 'styles', groups: [ 'styles' ] },
		    { name: 'colors', groups: [ 'colors' ] },
		    { name: 'tools', groups: [ 'tools' ] },
		    { name: 'others', groups: [ 'others' ] },
		    { name: 'about', groups: [ 'about' ] }
		];
		tbrmv = 'NewPage,ExportPdf,Preview,Print,Templates,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,CreateDiv,BidiLtr,BidiRtl,Language,Anchor,Flash,HorizontalRule,Smiley,SpecialChar,PageBreak,Iframe,TextColor,BGColor,Maximize,About,Format';

		CKEDITOR.plugins.addExternal( 'filebrowser', direction+'admin/assets/js/ckeditor4/filebrowser/', "plugin.js" );
		CKEDITOR.plugins.addExternal( 'videoembed', direction+'admin/assets/js/ckeditor4/videoembed/', "plugin.js" );
		CKEDITOR.replace("body", {
			extraPlugins: [ "filebrowser", "videoembed" ],
			filebrowserUploadUrl: direction+'php/db/request?request=blog_upload_file',
			allowedContent: true,
			toolbarGroups: tbgroups,
			removeButtons: tbrmv
		});
	});
</script>
