$('#Startcalendar').calendar({
	type: 'date',
	monthFirst: false,
	formatter: {
		date: function (date, settings) {
			if (!date) return '';
			var day = date.getDate();
			var month = date.getMonth() + 1;
			var year = date.getFullYear();
			return day + '/' + month + '/' + year;
		}
	}
});
$('#Endcalendar').calendar({
	type: 'date',
	monthFirst: false,
	formatter: {
		date: function (date, settings) {
			if (!date) return '';
			var day = date.getDate();
			var month = date.getMonth() + 1;
			var year = date.getFullYear();
			return day + '/' + month + '/' + year;
		}
	}
});