
var angleSec = 0;
var angleMin = 0;
var angleHour = 0;

$(document).ready(function () {
	$("#clock_seconds").rotate(angleSec);
	$("#clock_minutes").rotate(angleMin);
	$("#clock_hours").rotate(angleHour);
});

setInterval(function () {

	var d = new Date;

	angleSec = (d.getSeconds() * 6);
	$("#clock_seconds").rotate(angleSec);

	angleMin = (d.getMinutes() * 6);
	$("#clock_minutes").rotate(angleMin);

	angleHour = ((d.getHours() * 5 + d.getMinutes() / 12) * 6);
	$("#clock_hours").rotate(angleHour);

}, 1000);

