$('#main').infinitescroll(
	{
		navSelector: ".pagebrowser",
		nextSelector: ".pagebrowser a.next",
		itemSelector: "#main article.item",
		img: "/_Resources/Static/Packages/Planetflow3/Media/Images/ajax-loader-circle.gif"
	},function(arrayOfNewElems){
		window.setTimeout(function() {
			jQuery('.share').socialSharePrivacy("destroy");
			jQuery('.share').socialSharePrivacy();
		}, 500);
	}
);
$(document).ready(function() {
	jQuery('.share').socialSharePrivacy();
});