//Detect focus out　→　Detect input errors
$(function(){
	$('[name="url"]').on('blur', function(event){
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
			errLabel.text("正しいYouTubeのURLが入力されていません。");
			return;
		}
		// TODO:情報取得
		//SearchVideoDetails
	});
})