$('#main').infinitescroll(
	{
		navSelector: ".pagebrowser",
		nextSelector: ".pagebrowser a.next",
		itemSelector: "#main article.item",
		img: "/_Resources/Static/Packages/Planetflow3/Media/Images/ajax-loader-circle.gif"
	},function(arrayOfNewElems){
		/*window.setTimeout(function() {
			twttr.widgets.load();
			gapi.plusone.go();
		}, 500);*/
	}
);
$(document).ready(function() {
	jQuery('.share').socialSharePrivacy();
});