//$('.typeahead').typeahead({
//    source: function (query, process) {
//        return $.get('/typeahead', { query: query }, function (data) {
//            return process(data.options);
//        });
//    }
//});

$('.typeahead').typeahead([{
    name: 'countries',
    remote: '/countries.json'
}]);