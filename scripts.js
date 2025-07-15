// shortcuts
const $=document.querySelector.bind(document);
const $$=document.querySelectorAll.bind(document);
const $$$=window.getComputedStyle.bind(window);

// open/close mob nav
function OPEN_MN() {$(".mob_nav").classList.remove("mn_closed")}
function CLOSE_MN() {$(".mob_nav").classList.add("mn_closed")}

// Toggle
// open filter
function TGL_MN(id) {
	if (id > 0) {
		TGL=$(".mn_main"+id);
		INR=$(".mn_main"+id+" > ul");
		HGT=parseInt($$$(INR).getPropertyValue("height"))+parseInt($$$(INR).getPropertyValue("padding-bottom"));
		if (parseInt($$$(TGL).getPropertyValue("height")) <= 0) {		
			let i=0;
			let INT=setInterval(function() {
				i=i+10;
				TGL.style.height=i+"px";
				if (i >= HGT) {clearInterval(INT)}
			},10);
			if ($(".mn_arr"+id).getAttribute("class").indexOf("mob_nav_chevron_open") <= 0) {$(".mn_arr"+id).classList.add("mob_nav_chevron_open")}
		} else {
			let i=parseInt($$$(TGL).getPropertyValue("height"));
			let INT=setInterval(function() {
				i=i-10;
				TGL.style.height=i+"px";
				if (i <= 0) {clearInterval(INT);TGL.style.height="0px"}
			},10);
			if ($(".mn_arr"+id).getAttribute("class").indexOf("mob_nav_chevron_open") > 0) {$(".mn_arr"+id).classList.remove("mob_nav_chevron_open")}
		}
	}
}

// show image
function SHOWIMG(id) {
	let loader = $(".item_gallery_loader");
	loader.classList.add("gallery_loader_ani");
	let LIs = $$(".item_gallery_pnl li");
	LIs.forEach(li => {
		li.classList.remove("li_selected");
	});
	$("#img" + id).classList.add("li_selected");
	setTimeout(function () {loader.classList.remove("gallery_loader_ani")},200);	
}