// Detect focus out → Detect input errors → Get the details of that YouTube video
$(function(){
	$('[name="url"]').on('blur', function(event){
		//Delete previously obtained details		
		$("#thumbnail").val('');
		$("#title").val('');
	    $("#author").val('');
		const baseUrl = [
			"https://youtu.be/",
			"https://www.youtube.com/"
		];
		const target = $(this);
		const errLabel = $('[name="error"]'); 
		let isValid = false;

		for(const url of baseUrl){
			if(target.val().startsWith(url)){
				isValid = true;
			}
		}
		target.removeClass("invalid");
		errLabel.text("");
		if(!isValid){
			target.addClass("invalid");
			errLabel.html("正しいYouTubeのURLが入力されていません。<br/>「https://youtu.be/」か「https://www.youtube.com/」で始まるURLを入力してください。");
			return;
		}
		//SearchVideoDetails
		fetch("https://www.youtube.com/oembed?url=" + target.val())
		.then(response => {
			return response.json();
		})
		.then(data => {
			$("#thumbnail").val(data.thumbnail_url);
			$("#title").val(data.title);
		    $("#author").val(data.author_name);
		})
		.catch(error => {
			window.alert('動画情報の取得に失敗しました。\n入力したURLのYouTube動画が存在しないか\n非公開になった可能性があります。');
		})
	});
})